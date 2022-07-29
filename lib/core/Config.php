<?php

define('domain_name', (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']);
define('db_host', getenv("DB_HOST") ?? "");
class Config
{
    private static $configuration_data = array(
        // server properties
        "domain" => domain_name,

        // database credentials
        "db.dsn" => "mysql:host=" . db_host . ";dbname=adoptee;charset=utf8",
        "db.user" => null,
        "db.pass" => null,

        // email credentials
        "email.host" => null,
        "email.user" => null,
        "email.pass" => null,

        // GMaps credentials
        "maps.key" => null,

        // sms (Notify.lk) credentials
        "sms.user" => null,
        "sms.key" => null,

        // VideoSDK credentials
        "videosdk.key" => null,
        "videosdk.secret" => null,

        // Payment Gateway credentials
        "stripe.secret" => null,
        "stripe.publishable" => null
    );


    public static function get($key)
    {
        if (self::$configuration_data[$key]) {
            return self::$configuration_data[$key];
        } else {
            return getenv(strtoupper(str_replace('.', '_', $key)));
        };
    }
}
