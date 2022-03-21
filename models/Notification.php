<?php


class Notification extends BaseModel
{
    public static function sendNotification($user_id, $title, $message, $type = 'NOTIFICATION')
    {
        $query = "INSERT INTO `notifications` (`user_id`, `title`, `message`, `type`) VALUES (:user_id, :title, :message, :type)";
        self::insert($query, ["user_id" => $user_id, "title" => $title, "message" => $message, "type" => $type]);
        self::triggerProcessing();
    }

    public static function markAllSeen($user_id)
    {
        $query = "UPDATE `notifications` SET seen = true WHERE user_id = :user_id";
        self::update($query, ["user_id" => $user_id]);
    }

    public static function triggerProcessing()
    {
        $url = "http://127.0.0.1/main/send_notifications";
        $ctx = curl_init();
        curl_setopt_array($ctx, [CURLOPT_URL => $url,  CURLOPT_TIMEOUT_MS => 10, CURLOPT_RETURNTRANSFER => true]);
        curl_exec($ctx);
        curl_close($ctx);
    }

    public static function processQueue()
    {
        $notificationService = new EmailService();

        $query = "SELECT * FROM `notifications` n INNER JOIN `user` u on u.user_id = n.user_id WHERE sent = 0";
        $pending_notifications = self::select($query);

        foreach ($pending_notifications as $notif) {
            $notificationService->sendSMS("94" . (int) $notif['telephone'], $notif['message']);
            $notificationService->sendMail($notif['email'], $notif['name'], $notif['title'], $notif['message']);
            $update_query = "UPDATE `notifications` SET `sent` = '1' WHERE `notifications`.`notif_id` = :id";
            self::update($update_query, ["id" => $notif["notif_id"]]);
        }
    }
}
