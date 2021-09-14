<?php
class Message extends BaseModel
{
    public static function getMessagesOfConsultation($consultationId, $userId)
    {
        return self::select(
            "SELECT * , (:user_id = sender) 'is_sender' FROM `consultation_message` WHERE consultation_id = :consultation_id order by created_at",
            [
                "consultation_id" => $consultationId,
                "user_id" => $userId
            ]
        );
    }


    public static function postMessage($consultationId, $userId, $message, $medical_record_id = null)
    {
        return self::insert(
            "INSERT INTO `consultation_message` (`consultation_id`, `medical_record_id`, `sender`, `message`) VALUES (:consultation_id, :medical_record_id, :user_id, :message)",
            [
                "consultation_id" => $consultationId,
                "message" => $message,
                "user_id" => $userId,
                "medical_record_id" => $medical_record_id
            ]
        );
    }
}
