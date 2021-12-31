<?php


class Notification
{

    public static function sendNotification($user_id)
    {
        // insert into the notifications table 
        self::triggerProcessing();
    }


    public static function triggerProcessing()
    {
        $url = "http://127.0.0.1/api/process_notifications_queue";
        $ctx = curl_init();
        curl_setopt_array($ctx, [CURLOPT_URL => $url,  CURLOPT_TIMEOUT_MS => 10, CURLOPT_RETURNTRANSFER => TRUE]);
        curl_exec($ctx);
        curl_close($ctx);
    }

    public static function processQueue()
    {
        // select pending messages and send them
    }
}
