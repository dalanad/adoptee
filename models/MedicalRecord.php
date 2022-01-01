<?php

class MedicalRecord extends BaseModel
{
    public static function sendPrescription($consultation_id, $prescription)
    {
        $consultation = Consultation::findConsultationById($consultation_id);

        $medical_record_insert = "INSERT INTO `medical_record` (`animal_id`, `content`) VALUES (:animal_id, :content)";
        self::insert($medical_record_insert, ["animal_id" => $consultation["animal_id"], "content" => $prescription["remarks"]]);

        $medical_record_id = self::lastInsertId();

        $prescription_insert = "INSERT INTO `prescription` (`medical_record_id`, `next_visit_date`) VALUES (:medical_record_id, :next_visit_date)";
        self::insert($prescription_insert, ["medical_record_id" => $medical_record_id, "next_visit_date" => $prescription["next_visit_date"]]);

        $medicine_insert = "INSERT INTO `medicine` (`name`) VALUES (:name)";
        $prescription_item_insert = "INSERT INTO `prescription_item` (`medical_record_id`, `dose`, `duration`, `direction`, `medicine_id`) 
                                     VALUES (:medical_record_id, :dose, :duration, :direction, :medicine_id)";

        foreach ($prescription["items"] as $item) {
            self::insert($medicine_insert, ["name" => $item["name"]]);
            $medicine_id = self::lastInsertId();

            self::insert($prescription_item_insert, [
                "medical_record_id" => $medical_record_id,
                "dose" => $item["dose"],
                "duration" => $item["duration"],
                "direction" => $item["direction"],
                "medicine_id" => $medicine_id
            ]);
        }

        Message::postMessage($consultation_id, $_SESSION["user"]["user_id"], "PRESCRIPTION", $medical_record_id, []);
    }

    public static function getPrescriptionById($medical_record_id)
    {
        $query = "SELECT * FROM prescription p, medical_record m WHERE m.medical_record_id = p.medical_record_id AND m.medical_record_id = :medical_record_id";
        $prescription = self::selectOne($query, ["medical_record_id" => $medical_record_id]);

        $prescription_items_query = "SELECT * FROM prescription_item pi, medicine m WHERE pi.medicine_id = m.medicine_id AND pi.medical_record_id = :medical_record_id";
        $prescription['items'] = self::select($prescription_items_query, ["medical_record_id" => $medical_record_id]);

        return $prescription;
    }

    public static function getPrescriptionsByAnimalId($animal_id)
    {

        $query = "SELECT * FROM prescription p, medical_record m WHERE m.medical_record_id = p.medical_record_id AND m.animal_id = :animal_id";
        $prescriptions = self::select($query, ["animal_id" => $animal_id]);

        $prescriptions = array_map(function ($item) {
            $prescription_items_query = "SELECT * FROM prescription_item pi, medicine m WHERE pi.medicine_id = m.medicine_id AND pi.medical_record_id = :medical_record_id";
            $item['items'] = self::select($prescription_items_query, ["medical_record_id" => $item["medical_record_id"]]);
            return $item;
        }, $prescriptions);

        return $prescriptions;
    }

    public static function getMediaByAnimalId($animal_id)
    {
        $query = "SELECT cm.* 
                  FROM consultation_message cm, 
                    consultation c 
                  WHERE c.consultation_id = cm.consultation_id 
                    AND attachments is not NULL 
                    AND c.animal_id = :animal_id";
        $messages = self::select($query, ["animal_id" => $animal_id]);

        $attachments = [];

        foreach ($messages as $message) {
            array_push($attachments, ...json_decode($message["attachments"]));
        }

        return $attachments;
    }
}
