<?php
class Crypto
{

    public static function hash($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }


    public static function verify($string, $hash)
    {
        return password_verify($string,   $hash);
    }

    public static function encrypt($string, $hash)
    {
        #
    }

    public static function decrypt($string, $hash)
    {
        #
    }
}
