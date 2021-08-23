<?php

class Config
{
    private static $configuration_data = array(
        "db" => array(
            "host" => "localhost",
            "user" => "root",
            "password" => "root",
            "database" => "adoptee"
        ),
        "email" => array("smtp_host", "user", "password"),
        "maps" => array("key"=>""),
        "sms" => array(""),
        "zoom"=> array("")
    );


    public static function get($key)
    {
        return self::$configuration_data[$key];
    }
}
