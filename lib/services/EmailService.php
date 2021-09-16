<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/PHPMailer-6.5.0/src/Exception.php';
require 'lib/vendor/PHPMailer-6.5.0/src/PHPMailer.php';
require 'lib/vendor/PHPMailer-6.5.0/src/SMTP.php';


class EmailService
{

    public function sendMail($to, $toName, $subject, $body)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();                            // Send using SMTP
        $mail->Host       = config::get("email.host");    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;

        //Enable SMTP authentication
        $mail->Username   = config::get("email.user");               // SMTP username
        $mail->Password   = config::get("email.pass");

        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('noreply@adoptee.lk', 'Adoptee');
        $mail->addAddress("$to", "$toName");     // Add a recipient

        //Content
        $mail->isHTML(true);                     // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
    }

    public function sendSMS($to_address, $message)
    {
        $user_id = config::get("sms.user");
        $api_key = config::get("sms.key");

        // send HTTP get request to the API
        file_get_contents("https://app.notify.lk/api/v1/send?user_id=$user_id&api_key=$api_key&sender_id=NotifyDEMO&to=$to_address&message=$message");
    }
}
