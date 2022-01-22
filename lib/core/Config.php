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
        "db.user" => "root",
        "db.pass" => "root",

        // email credentials
        "email.host" => "smtp.sendgrid.net",
        "email.user" => "apikey",
        "email.pass" => "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",

        // GMaps credentials
        "maps.key" => "AIzaSyBSB7zeeAI3QC42UmxHEFqS715ulfPFASc",

        // sms (Notify.lk) credentials
        "sms.user" => "13947",
        "sms.key" => "oHMY3jsF85FFUo9AWvWz",

        // VideoSDK credentials
        "videosdk.key" => "136ee81a-3694-47bf-8fe1-777df33a8467",
        "videosdk.secret" => "1dce5c535747b314ae1126641ad7c51f788026be2de628efc915080f9eae5cf3",

        // Payment Gateway credentials
        "stripe.secret" => "sk_test_51JBINKEu3mtzXdk1hnpQNEAIMfA93QrzvlckDFM5y6xI0JDLptM8k13RF0MTBhTzDUkZG4lMxli88h54SwKp0VeZ00csMtwzQJ",
        "stripe.publishable" => "pk_test_51JBINKEu3mtzXdk1RZaQ4mqJoyuHQS7ZL9UdpSrR3oDcRgkbNmCTl9dEKTK5KigEoeDBwO89lCtyQKydIBL7Mf2q00POFEpI41"
    );


    public static function get($key)
    {
        return self::$configuration_data[$key];
    }
}
