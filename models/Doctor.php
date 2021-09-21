<?php

class Doctor extends BaseModel
{
    public static function createDoctor($user_id, $reg_no, $credentials, $telephone_fixed, MultipleImages $proof_image)
    {
        $query = "INSERT INTO doctor (user_id, reg_no, credentials,telephone_fixed, proof_image) 
                  VALUES (:user_id, :reg_no,  :credentials,:telephone_fixed, :proof_image)";

        $params = [
            "user_id" => $user_id,
            "reg_no" => $reg_no,
            "credentials" => $credentials,
            "telephone_fixed" => $telephone_fixed,
            "proof_image" => json_encode($proof_image->getURL())
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

        $query = "INSERT INTO `consultation_schedule` (`doctor_user_id`, `day_of_week`, `time_slot`, `available`) VALUES (:doctor_user_id, :day_of_week, :time_slot, :available)";
        $i = 0;
        foreach ($schedule as $date => $slots) {
            foreach ($slots as $slot => $status) {
                if ($status == "AVAILABLE") {
                    $data = ["doctor_user_id" => $doc_id, "day_of_week" => $i, "time_slot" => $slot, "available" => 1];
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
            $schedule[$res["day_of_week"]][$res["time_slot"]] = 1;
        }
        return $schedule;
    }


    public static function getSlots(int $doc_id, $date)
    {
        return self::select(
            "SELECT
                s.doctor_user_id,
                ('2021-09-08') 'date',
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


    public static function getConsultedAnimals($doctorId)
    {
        $query = "SELECT c.*,u.name 'owner_name' ,a.*, ROUND(DATEDIFF(CURRENT_DATE, a.dob) / 365) 'age' FROM 
         (SELECT DISTINCT animal_id, user_id FROM consultation WHERE consultation.doctor_user_id = :doctor_id ) c, animal a,user u
         WHERE a.animal_id = c.animal_id and u.user_id = c.user_id";

        return self::select($query, ["doctor_id" => $doctorId]);
    }
}