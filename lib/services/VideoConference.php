<?php
class VideoConference
{
    public static function createAuthToken()
    {
        return Crypto::generate_jwt(
            [
                "apikey" => Config::get("videosdk.key"),
                "permissions" => ["allow_join", "allow_mod", "ask_join"],
                "iat" => time() ,
                "exp" => time() + 1000
            ],
            Config::get("videosdk.secret")
        );
    }


    public function createMeetingId()
    {
        $authorization_token = $this->createAuthToken();

        $ch = curl_init('https://api.zujonow.com/v1/meetings');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            "Authorization: $authorization_token"
        ));

        // execute!
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        // close the connection, release resources used
        curl_close($ch);

        if (isset($error_msg)) {
            throw new Error("Meeting Creation Failed");
            //echo $error_msg;
        }

        return json_decode($response)->meetingId;
    }
}
