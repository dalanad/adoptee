<?php
class Crypto
{
    private static $key = "7EiWd8OxaSj2mmrbn4jEBAc4OUTRV5KTDJEfWm4MsjE";
    private static $algo = "AES-128-CBC";

    public static function hash(string $string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    public static function verify(string $string, string $hash)
    {
        return password_verify($string, $hash);
    }

    public static function encrypt(string $plaintext)
    {
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($plaintext, self::$algo, self::$key, 0, $iv);

        return base64_encode($iv . $encrypted);
    }

    public static function decrypt(string $cipher_text)
    {
        $decoded = base64_decode($cipher_text);
        $iv =  substr($decoded, 0, 16);
        $cipher = substr($decoded, 16);
        $decrypted = openssl_decrypt($cipher, self::$algo, self::$key, 0, $iv);
        
        return  $decrypted;
    }
}
