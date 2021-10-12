<?php
class Message extends BaseModel
{
    public static function getMessagesOfConsultation($consultationId, $userId)
    {
        assert(isset($consultationId) && $consultationId != "", isset($consultationId) && $consultationId != "");

        return self::select(
            "SELECT * , (:user_id = sender) 'is_sender' FROM `consultation_message` WHERE consultation_id = :consultation_id order by created_at",
            [
                "consultation_id" => $consultationId,
                "user_id" => $userId
            ]
        );
    }


    public static function postMessage($consultationId, $userId, $message, $medical_record_id = null, $attachments = [])
    {
        assert(isset($consultationId) && $consultationId != "");

        return self::insert(
            "INSERT INTO `consultation_message` (`consultation_id`, `medical_record_id`, `sender`, `message`,`attachments`) 
             VALUES (:consultation_id, :medical_record_id, :user_id, :message,:attachments)",
            [
                "consultation_id" => $consultationId,
                "message" => $message,
                "user_id" => $userId,
                "medical_record_id" => $medical_record_id,
                "attachments" => json_encode($attachments)
            ]
        );
    }
}
