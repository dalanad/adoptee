<?php

class Doctor extends BaseModel
{
    public static function createDoctor($user_id, $reg_no, $credentials, $telephone_fixed, Image $proof_image)
    {
        $query = "INSERT INTO doctor (user_id, reg_no, credentials,telephone_fixed, proof_image) 
                  VALUES (:user_id, :reg_no,  :credentials,:telephone_fixed, :proof_image)";

        $params = [
            "user_id" => $user_id,
            "reg_no" => $reg_no,
            "credentials" => $credentials,
            "telephone_fixed" => $telephone_fixed,
            "proof_image" => $proof_image->getURL()
        ];

        return self::insert($query, $params);
    }

    public static function getDoctors()
    {
        return self::select("SELECT * from doctor");
    }

    public static function findByUID($user_id)
    {
        $query = "SELECT *  from `doctor` where user_id= '$user_id'";
        return self::select($query);
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
}
