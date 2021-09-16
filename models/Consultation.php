<?php
class Consultation extends BaseModel
{

    public static function bookConsultation($doctorId, $userId, $animalId, $date, $time, $type)
    {
        $query = " INSERT INTO `consultation` ( `consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `payment_txn_id`) 
        VALUES ('2021-09-08', '10:30:00', '4', '1', '3', 'PENDING', 'LIVE', NULL);";
    }

    public static function getBookingsCalender($doctorId, $start_date, $end_date)
    {
        $bookings = [];

        $result = self::select(
            "SELECT * FROM `consultation` WHERE doctor_user_id = :user_id AND TYPE = 'LIVE' AND consultation_date BETWEEN :start_date AND :end_date ",
            ["user_id" => $doctorId, "start_date" => $start_date, "end_date" => $end_date]
        );

        foreach ($result as $res) {
            $res["animal"] =  Animal::getAnimalById($res["animal_id"]);
            $bookings[$res["consultation_date"]][$res["consultation_time"]] = $res;
        }
        return $bookings;
    }

    public static function getConsultationById($consultationId)
    {

        $consultations = self::select("SELECT * FROM `consultation` WHERE consultation_id = :consultation_id limit 1 ", ["consultation_id" => $consultationId]);

        $consultations = array_map(function ($item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            return $item;
        }, $consultations);


        return $consultations[0];
    }

    public static function getConsultations($doctorId)
    {

        $consultations = self::select("SELECT * FROM `consultation` WHERE doctor_user_id = :user_id and status in ('ACCEPTED','COMPLETED')", ["user_id" => $doctorId]);

        $consultations = array_map(function ($item) {
            $item["animal"] =  Animal::getAnimalById($item["animal_id"]);
            return $item;
        }, $consultations);


        return $consultations;
    }
}
