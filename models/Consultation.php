<?php

class Consultation extends BaseModel
{

    public static function bookConsultationPet($doctorId, $userId, $type, $date, $time,  $animalId)
    {
        $query = "INSERT INTO `consultation` (`consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `created_date`) 
                  VALUES (:date, :time, :animal_id, :doctor_id, :user_id, :status, :type, CURRENT_DATE);";

        self::insert($query, [
            "date" => $date,
            "time" => $time,
            "animal_id" => $animalId,
            "doctor_id" => $doctorId,
            "user_id" => $userId,
            "status" => ($type == 'ADVISE' ? 'ACCEPTED' : 'PENDING'),
            "type" => $type,
        ]);

        return self::lastInsertId(); //to insert the txn_id into consultation table later
    }

    public static function bookConsultationNewPet($doctorId, $userId, $type, $date, $time,  $name, $gender, $animal_type, $dob)
    {
        $query = "INSERT INTO `animal` (type, name, gender, dob) VALUES (:animal_type, :name, :gender, :dob);";

        self::insert($query, [
            "animal_type" => $animal_type,
            "name" => $name,
            "gender" => $gender,
            "dob" => $dob
        ]);

        $animalId = self::lastInsertId();

        $query = "INSERT INTO `user_pet` (`animal_id`, `user_id`) VALUES (:animal_id, :user_id)";

        self::insert($query, ["animal_id" => $animalId, "user_id" => $userId]);

        return self::bookConsultationPet($doctorId, $userId, $type, $date, $time, $animalId);
    }

    public static function recordPayment($session)
    {
        //insert into payment table
        $user = $_SESSION["user"]["user_id"];
        $id = $session['id'];
        $amount = $session['amount_total'] / 100;
        $consultation_id = $session["client_reference_id"];

        $query = "INSERT INTO `payment`(txn_id,amount,user) VALUES('$id', $amount, $user);";
        self::insert($query);

        // update consultation table with the payment
        $query = "UPDATE `consultation` set payment_txn_id = '$id' WHERE consultation_id = $consultation_id;";
        self::insert($query);
    }

    public static function getBookingsCalender($doctorId, $start_date, $end_date)
    {
        assert(isset($doctorId) && isset($start_date) && isset($end_date) && $doctorId != "" && $start_date != "" && $end_date != "");

        $bookings = [];
        $sort = $_GET["sort"];
        $sort_dir = $_GET["sort_dir"];
        $animal_type = $_GET["type"];

        $query = "SELECT c.*, 
                        a.type as animal_type ,
                        c.consultation_time as time 
                    FROM `consultation` c , animal a
                    WHERE c.animal_id = a.animal_id 
                        AND c.doctor_user_id = $doctorId 
                        AND c.TYPE = 'LIVE' 
                        AND c.consultation_date BETWEEN '$start_date' AND '$end_date' " .
            ($animal_type != "ANY" ? " AND UPPER(a.type) = UPPER('$animal_type')" : "") .
            " ORDER BY $sort $sort_dir";
        // print_r($query);
        $result = self::select(
            $query,
        );

        foreach ($result as $item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            $item["user"] =  User::findUserById($item["user_id"]);
            $bookings[$item["consultation_date"]][$item["consultation_time"]] = $item;
        }
        return $bookings;
    }

    public static function findConsultationById($consultationId)
    {
        assert(isset($consultationId) && $consultationId != "");

        $consultations = self::select("SELECT * FROM `consultation` WHERE consultation_id = :consultation_id limit 1 ", ["consultation_id" => $consultationId]);

        $consultations = array_map(function ($item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            $item["user"] =  User::findUserById($item["user_id"]);
            $item["doctor"] =  User::findUserById($item["doctor_user_id"]);
            return $item;
        }, $consultations);


        return $consultations[0];
    }

    public static function findConsultationsByDoctorId($doctorId, $type, $search, $status = "ALL")
    {

        $query =  "SELECT 
                    c.*,
                    (SELECT count(*) 'count' FROM `consultation_message` cm 
                    WHERE cm.consultation_id = c.consultation_id AND seen = FALSE AND sender != :user_id ) 'new_msgs'
                FROM `consultation` c
                    inner join animal a on a.animal_id = c.animal_id
                    WHERE c.doctor_user_id = $doctorId
                    and status in ('ACCEPTED','COMPLETED') "
            . (isset($type) && $type != "ANY" ? " and c.type = '$type' " : "")
            . ($status != "ALL" ? " and c.status = '$status' " : "")
            . (isset($search) && $search != "" ? " and a.name like '%$search%' " : "")
            . " ORDER BY new_msgs DESC ";

        $consultations = self::select($query, ["user_id" => $doctorId]);
        //print_r($query);
        $consultations = array_map(function ($item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            $item["user"] =  User::findUserById($item["user_id"]);
            return $item;
        }, $consultations);


        return $consultations;
    }

    public static function complete_user($consultation_id, $doctor_rating)
    {
        $query = "UPDATE `consultation` SET status = 'COMPLETED' , doctor_rating =:doctor_rating WHERE consultation_id = :consultation_id ";
        $params = [
            "consultation_id" => $consultation_id,
            "doctor_rating" => $doctor_rating
        ];

        return self::update($query, $params);
    }

    public static function complete_doctor($consultation_id, $user_rating)
    {
        $query = "UPDATE `consultation` SET status = 'COMPLETED' WHERE consultation_id = :consultation_id ";

        $params = [
            "consultation_id" => $consultation_id,
        ];

        self::update($query, $params);

        $con =  Consultation::findConsultationById($consultation_id);
        $doctor = User::findUserById($con["doctor_user_id"]);
        Notification::sendNotification(
            $con["user_id"],
            "Doctor Consultaion Completed",
            "Thank You. Your consultation with " . $doctor["name"] . " has been completed "
        );
    }

    public static function findConsultationsByPetId($animal_id)
    {
        $consultations = self::select("SELECT * FROM `consultation` WHERE animal_id = :animal_id and status in ('ACCEPTED','PENDING','COMPLETED')", ["animal_id" => $animal_id]);
        return $consultations;
    }

    public static function getPetConsultation($animalId)
    {
        $query = "SELECT c.*, cm.consultation_id, cm.message, user_pet.animal_id
            FROM consultation c, consultation_message cm, user_pet
            WHERE c.animal_id=user_pet.animal_id
            AND c.status='COMPLETED'
            AND cm.consultation_id=c.consultation_id
            AND user_pet.animal_id = $animalId";
        return self::select($query);
    }

    public static function getUpcomingConsultations($animalId)
    {
        $query = "SELECT c.* FROM consultation c
            WHERE animal_id = $animalId
            AND (status = 'PENDING' OR status = 'ACCEPTED');";
    }
}
