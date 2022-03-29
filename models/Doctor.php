<?php

class Doctor extends BaseModel
{
    public static function createDoctor($user_id, $reg_no, $credentials, $telephone_fixed, $proof_image)
    {
        $query = "INSERT INTO doctor (user_id, reg_no, credentials,telephone_fixed, proof_image) 
                  VALUES (:user_id, :reg_no,  :credentials,:telephone_fixed, :proof_image)";

        $params = [
            "user_id" => $user_id,
            "reg_no" => $reg_no,
            "credentials" => $credentials,
            "telephone_fixed" => $telephone_fixed,
            "proof_image" =>  $proof_image
        ];

        return self::insert($query, $params);
    }

    public static function getDoctors()
    {
        return self::select("SELECT 
            *, 
            (   SELECT ROUND(AVG(doctor_rating)) as rating 
                FROM consultation 
                WHERE doctor_user_id = u.user_id AND doctor_rating IS NOT NULL
            ) as rating 
        FROM doctor d INNER JOIN user u ON u.user_id = d.user_id");
    }

    public static function findByUID($user_id)
    {
        $query = "SELECT *  from `doctor` INNER JOIN user ON user.user_id = doctor.user_id where doctor.user_id= :id";
        return self::select($query, ["id" => $user_id]);
    }

    public static function accept_consultation_request($doctor_id, $consultation_id)
    {  
        $query = "UPDATE `consultation` SET status = 'ACCEPTED', meeting_id = :meeting_id WHERE doctor_user_id = :doctor_id and consultation_id = :consultation_id";

        $params = [
            "doctor_id" => $doctor_id,
            "consultation_id" => $consultation_id,
            "meeting_id" => VideoConference::createMeetingId()
        ];

        self::update($query, $params);

        $con =  Consultation::findConsultationById($consultation_id);
        $doctor = User::findUserById($doctor_id);
        Notification::sendNotification(
            $con["user_id"],
            "Doctor Consultation Accepted",
            $doctor["name"] . " accepted your consultation on " . $con["consultation_date"] . " @ " . $con["consultation_time"]
        );
    }

    public static function cancel_consultation_request($doctor_id, $consultation_id)
    {
        $query = "UPDATE `consultation` SET status = 'CANCELLED' WHERE doctor_user_id = :doctor_id and consultation_id = :consultation_id";

        $params = [
            "doctor_id" => $doctor_id,
            "consultation_id" => $consultation_id,
        ];

        self::update($query, $params);
        $consultation =  Consultation::findConsultationById($consultation_id);
        Pay::refundPayment($consultation["payment_txn_id"]);

        $query = "UPDATE `payment` SET status = 'REFUNDED' WHERE txn_id = :txn_id ";
        $params = [
            "txn_id" => $consultation["payment_txn_id"],
        ];
        self::update($query, $params);

        $con =  Consultation::findConsultationById($consultation_id);
        $doctor = User::findUserById($doctor_id);
        Notification::sendNotification(
            $con["user_id"],
            "Doctor Consultation Cancelled",
            $doctor["name"] . " cancelled your consultation on " . $con["consultation_date"] . " @ " . $con["consultation_time"]
        );
    }

    public static function updateCharges($doctor_id, $live_charge, $advise_charge)
    {
        $query = "UPDATE `doctor` SET advise_charge = :advise_charge, live_charge = :live_charge WHERE user_id = :doctor_id ";

        $params = [
            "doctor_id" => $doctor_id,
            "advise_charge" => $advise_charge,
            "live_charge" => $live_charge,
        ];

        return self::update($query, $params);
    }

    /**
     * Updates the doctors schedule with the given data
     *
     * @param int $doc_id user Id of the doctor
     * @param array
     * @return boolean true if success
     *
     * */
    public static function updateSchedule(int $doc_id, array $schedule)
    {
        // clear current schedule
        self::insert('DELETE FROM `consultation_schedule` WHERE doctor_user_id = :user_id', ["user_id" => $doc_id]);

        $query = "INSERT INTO `consultation_schedule` (`doctor_user_id`, `day_of_week`, `time_slot`, `charge`) VALUES (:doctor_user_id, :day_of_week, :time_slot, :charge)";
        $i = 0;
        foreach ($schedule as $date => $slots) {
            foreach ($slots as $slot => $charge) {
                if (!is_null($charge)) {
                    $data = ["doctor_user_id" => $doc_id, "day_of_week" => $i, "time_slot" => $slot, "charge" => $charge];
                    self::insert($query, $data);
                }
            }
            $i++;
        }
    }

    /**
     * Retrieves the doctors schedule with the given doctorId
     *
     * @param int $doc_id user Id of the doctor
     * @return array containing the schedule
     *
     * */
    public static function getSchedule(int $doc_id)
    {
        $schedule = [];
        $result = self::select('select * FROM `consultation_schedule` WHERE doctor_user_id = :user_id', ["user_id" => $doc_id]);

        foreach ($result as $res) {
            $schedule[$res["day_of_week"]][$res["time_slot"]] = $res["charge"];
        }
        return $schedule;
    }


    public static function getSlots(int $doc_id, $date)
    {
        return self::select(
            "SELECT
                s.doctor_user_id,
                $date 'date',
                s.time_slot,
                c.consultation_id
            FROM
                consultation_schedule s
            LEFT JOIN consultation c ON
                WEEKDAY(c.consultation_date) = s.day_of_week AND c.consultation_time = s.time_slot and c.consultation_date = :date
            WHERE 
            s.doctor_user_id = :doc_id AND day_of_week =(WEEKDAY(:date))",
            ["doc_id" => $doc_id, "date" =>  $date]
        );
    }


    public static function getConsultedAnimals($doctorId, $filter)
    {
        $query = "SELECT SQL_CALC_FOUND_ROWS  c.*, u.name 'owner_name', a.*, ROUND( DATEDIFF(CURRENT_DATE, a.dob) / 365 ) 'age' FROM 
        ( SELECT DISTINCT animal_id, user_id, MAX(consultation.consultation_date) 'last_consultation' FROM consultation
         WHERE consultation.doctor_user_id = :doctor_id  and consultation.status='COMPLETED' GROUP BY consultation.animal_id, consultation.user_id ) c, 
         animal a, user u WHERE a.animal_id = c.animal_id AND u.user_id = c.user_id";

        // filter by gender
        $gender =  $filter["gender"];
        if ($gender != "Any") {
            $query = $query . " AND a.gender = '$gender' ";
        }

        // filter by type
        $type =  $filter["type"];
        if (sizeof($type) > 0) {
            $query = $query . " AND a.type IN ('" . implode("','", $type) . "') ";
        }

        // search keyword
        $search =  $filter["search"];
        if ($search != "") {
            $query = $query . " AND ( a.name like '%$search%' OR u.name like '%$search%' )";
        }

        // sort
        $sort =  $filter["sort"];
        if (isset($sort) && sizeof($sort) > 0) {
            $directions = [];
            foreach ($sort as $column => $direction) {
                array_push($directions, " $column $direction ");
            }
            $query = $query . " ORDER BY " . implode(",", $directions);
        }

        // pagination
        $query = $query . " LIMIT " . $filter['size'] . " OFFSET " . (intval($filter['size']) * intval($filter['page']));

        return [
            "items" => self::select($query, ["doctor_id" => $doctorId]),
            "count" => self::selectOne("SELECT FOUND_ROWS() total ")["total"]
        ];
    }

    public static function MonthlyConsultationsByType($doctor_id)
    {
        $monthly = ["cats" => [], "dogs" => [], "other" => []];

        $query = "SELECT
            month(consultation_date) mon,
            COUNT(IF(animal.TYPE = 'DOG', 1, NULL)) dogs,
            COUNT(IF(animal.TYPE = 'CAT', 1, NULL)) cats,
            COUNT(IF(animal.TYPE != 'CAT' and animal.type != 'DOG', 1, NULL)) other
        FROM
            consultation inner join animal on consultation.animal_id = animal.animal_id 
        WHERE
            consultation_date BETWEEN NOW() - INTERVAL 6 MONTH AND NOW() 
            AND doctor_user_id = :doctor_id
        GROUP BY
            month(consultation_date) order by mon ";

        $result = self::select($query, ["doctor_id" => $doctor_id]);


        $j = 0;

        for ($i = 5; $i >= 0; $i--) {
            $date = date("m", strtotime("-$i month"));

            if (isset($result[$j]) && $date == $result[$j]["mon"]) {
                array_push($monthly["cats"], $result[$j]["cats"]);
                array_push($monthly["dogs"], $result[$j]["dogs"]);
                array_push($monthly["other"], $result[$j]["other"]);
                $j++;
            } else {
                array_push($monthly["cats"], 0);
                array_push($monthly["dogs"], 0);
                array_push($monthly["other"], 0);
            }
        }

        return  $monthly;
    }

    public static function DailyConsultationsByMode($doctor_id)
    {
        $consultations = ["live" => [], "advise" => []];

        $query = "SELECT  
                    consultation_date, 
                    COUNT(if(type='LIVE',1,null)) live, 
                    COUNT(if(type='ADVISE',1,null)) advise
                FROM consultation 
                    WHERE consultation_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW() 
                    AND doctor_user_id = :doctor_id
                GROUP BY consultation_date";

        $result = self::select($query, ["doctor_id" => $doctor_id]);

        $j = 0;
        for ($i = 30; $i >= 0; $i--) {
            $date = date("Y-m-d", strtotime("-$i days"));
            if (isset($result[$j]) && $date == $result[$j]["consultation_date"]) {
                array_push($consultations["live"], $result[$j]["live"]);
                array_push($consultations["advise"], $result[$j]["advise"]);
                $j++;
            } else {
                array_push($consultations["live"], 0);
                array_push($consultations["advise"], 0);
            }
        }

        return  $consultations;
    }

    public static function getPaymentHistory($doctor_id, $filter)
    {
        $query = "SELECT SQL_CALC_FOUND_ROWS p.*,
                      CONCAT('Payment for Consultation - ', c.type, ' - #', c.consultation_id) description
                  FROM payment p
                      LEFT JOIN consultation c ON p.txn_id = c.payment_txn_id
                  WHERE (c.doctor_user_id = :doctor_id OR p.user = :doctor_id)";



        // filter by type
        $type =  $filter["type"];
        if (sizeof($type) > 0) {
            $query = $query . " AND p.type IN ('" . implode("','", $type) . "') ";
        }

        // filter by type
        $type =  $filter["status"];
        if (sizeof($type) > 0) {
            $query = $query . " AND p.status IN ('" . implode("','", $type) . "') ";
        }

        // sort
        $sort =  $filter["sort"];
        if (isset($sort) && sizeof($sort) > 0) {
            $directions = [];
            foreach ($sort as $column => $direction) {
                array_push($directions, " $column $direction ");
            }
            $query = $query . " ORDER BY " . implode(",", $directions);
        }

        $query = $query . " LIMIT " . $filter['size'] . " OFFSET " . (intval($filter['size']) * intval($filter['page']));
        return [
            "items" => self::select($query, ["doctor_id" => $doctor_id]),
            "count" => self::selectOne("SELECT FOUND_ROWS() total ")["total"]
        ];
    }

    public static function getPaymentBalance($doctor_id)
    {
        $payments_query = "SELECT SUM(amount) total FROM payment p JOIN consultation c ON p.txn_id = c.payment_txn_id WHERE c.doctor_user_id = :doctor_id AND p.status != 'REFUNDED'";
        $total_payments = self::select($payments_query, ["doctor_id" => $doctor_id])[0]["total"];

        $withdrawal_query = "SELECT SUM(amount) total FROM payment p WHERE p.user = :doctor_id AND p.type = 'WITHDRAWAL'";
        $total_withdrawals = self::select($withdrawal_query, ["doctor_id" => $doctor_id])[0]["total"];
        return $total_payments - $total_withdrawals;
    }

    public static function recordWithdrawal($doctor_id, $amount, $txn_id)
    {
        $query = "INSERT INTO `payment` (`txn_id`,`amount`,`user`,`type`) VALUES (:txn_id, :amount, :doctor_id, 'WITHDRAWAL')";
        self::insert($query, ["doctor_id" => $doctor_id, "txn_id" => $txn_id, "amount" => $amount]);
    }

    public static function getMedicines($doctor_id)
    {
        $query = "SELECT * FROM medicine where doctor_id = :doctor_id";
        return self::select($query, ["doctor_id" => $doctor_id]);
    }

    public static function getMedicine($medicine_id)
    {
        $query = "SELECT * FROM medicine where medicine_id = :medicine_id ";
        return self::selectOne($query, ["medicine_id" => $medicine_id]);
    }

    public static function saveMedicine($doctor_id, $medicine)
    {
        if (isset($medicine["medicine_id"])) {

            $query = "UPDATE medicine SET 
                    name = :name,
                    age_min = :age_min,
                    age_max = :age_max,
                    weight_min = :weight_min,
                    weight_max = :weight_max
                WHERE medicine_id = :medicine_id AND doctor_id = :doctor_id";

            self::update($query, [
                "name" => $medicine["name"],
                "medicine_id" => $medicine["medicine_id"],
                "doctor_id" => $doctor_id,
                "age_min" => $medicine["age_min"],
                "age_max" => $medicine["age_max"],
                "weight_min" => $medicine["weight_min"],
                "weight_max" => $medicine["weight_max"],
            ]);
        } else {

            $query = "INSERT INTO medicine(name,doctor_id,age_min,age_max,weight_min,weight_max) 
                      VAlUES (:name,:doctor_id,:age_min,:age_max,:weight_min,:weight_max)";
            self::insert($query, [
                "name" => $medicine["name"], "doctor_id" => $doctor_id,
                "age_min" => $medicine["age_min"],
                "age_max" => $medicine["age_max"],
                "weight_min" => $medicine["weight_min"],
                "weight_max" => $medicine["weight_max"],
            ]);
        }
    }

    public static function getDoctorRating($doctor_id)
    {
        $query = "SELECT ROUND(AVG(doctor_rating)) as rating FROM consultation WHERE doctor_user_id = :doctor_id AND doctor_rating IS NOT NULL;";
        return self::selectOne($query, ["doctor_id" => $doctor_id])["rating"];
   
    }
}
