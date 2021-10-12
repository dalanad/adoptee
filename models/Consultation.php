<?php
class Consultation extends BaseModel
{

    public static function bookConsultationPet($doctorId, $userId, $type, $date, $time,  $animalId)
    {
        $query = "INSERT INTO `consultation` (`consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `payment_txn_id`) 
        VALUES ('$date', '$time', '$animalId', '$doctorId', '$userId', 'PENDING', '$type', NULL);";
        return self::insert($query);
    }

    public static function bookConsultationNewPet($doctorId, $userId, $type, $date, $time,  $name, $gender, $animal_type, $dob)
    {
        $query = "INSERT INTO `animal` (type, name, gender, dob) VALUES ('$animal_type','$name', '$gender', '$dob');";
        self::insert($query);
        $animalId = self::lastInsertId();
        return self::bookConsultationPet($doctorId, $userId, $type, $date, $time, $animalId);
    }

    public static function getBookingsCalender($doctorId, $start_date, $end_date)
    {
        assert(isset($doctorId) && isset($start_date) && isset($end_date) && $doctorId != "" && $start_date != "" && $end_date != "");

        $bookings = [];

        $result = self::select(
            "SELECT * FROM `consultation` WHERE doctor_user_id = :user_id AND TYPE = 'LIVE' AND consultation_date BETWEEN :start_date AND :end_date ",
            ["user_id" => $doctorId, "start_date" => $start_date, "end_date" => $end_date]
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
            return $item;
        }, $consultations);


        return $consultations[0];
    }

    public static function findConsultationsByDoctorId($doctorId)
    {

        $consultations = self::select("SELECT * FROM `consultation` WHERE doctor_user_id = :user_id and status in ('ACCEPTED','COMPLETED')", ["user_id" => $doctorId]);

        $consultations = array_map(function ($item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            $item["user"] =  User::findUserById($item["user_id"]);
            return $item;
        }, $consultations);


        return $consultations;
    }


    public static function findConsultationsByPetId($animal_id)
    {
        $consultations = self::select("SELECT * FROM `consultation` WHERE animal_id = :animal_id and status in ('ACCEPTED','PENDING','COMPLETED')", ["animal_id" => $animal_id]);
        return $consultations;
    }

    public static function getPetConsultation()
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
        $query = "SELECT c.*
        FROM consultation c
        WHERE animal_id = $animalId
        AND (status = 'PENDING'
        OR status = 'ACCEPTED');";
    }
}
