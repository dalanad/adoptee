<?php

class Config
{
    private static $configuration_data = array(
        // database credentials
        "db.dsn" => "mysql:host=;dbname=adoptee;charset=utf8",
        "db.user" => "root",
        "db.pass" => "root",

        // email credentials
        "email.host" => "smtp.sendgrid.net",
        "email.user" => "apikey",
        "email.pass" => "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",

        // GMaps credentials
        "maps.key" => "AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk",

        // sms (Notify.lk) credentials
        "sms.user" => "13947",
        "sms.key" => "oHMY3jsF85FFUo9AWvWz",

        // VideoSDK credentials
        "videosdk.key" => "136ee81a-3694-47bf-8fe1-777df33a8467",
        "videosdk.secret" => "1dce5c535747b314ae1126641ad7c51f788026be2de628efc915080f9eae5cf3",

        // Payment Gateway credentials
        "stripe" => ""
    );


    public static function get($key)
    {
        return self::$configuration_data[$key];
    }
}
