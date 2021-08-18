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

                    
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        //Enable SMTP authentication
        $mail->Username   = 'apikey';                     //SMTP username
        $mail->Password   = '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';
        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply@adoptee.lk', 'Adoptee');
        $mail->addAddress("$to", "$toName");     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
    }
}
