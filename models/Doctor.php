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
        return self::select("SELECT * FROM doctor INNER JOIN user ON user.user_id = doctor.user_id");
    }

    public static function findByUID($user_id)
    {
        $query = "SELECT *  from `doctor` INNER JOIN user ON user.user_id = doctor.user_id where doctor.user_id= :id";
        return self::select($query, ["id" => $user_id]);
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
         animal a, USER u WHERE a.animal_id = c.animal_id AND u.user_id = c.user_id";

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
}
