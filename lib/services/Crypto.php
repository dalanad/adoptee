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

        return urlencode(base64_encode($iv . $encrypted));
    }

    public static function decrypt(string $cipher_text)
    {
        $decoded = base64_decode($cipher_text);
        $iv =  substr($decoded, 0, 16);
        $cipher = substr($decoded, 16);
        $decrypted = openssl_decrypt($cipher, self::$algo, self::$key, 0, $iv);
        
        return  $decrypted;
    }

    /** Needed for the video conferencing integration */
    public static function generate_jwt($payload_obj, $secret)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload_obj);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }
}
