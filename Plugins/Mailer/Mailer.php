<?php

namespace Plugins\Mailer;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{

    public $error;
    public $status;
    public $token;


    public function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    public function logo($path=null)
    {
        if(is_null($path))
        {
            $path = "<img src='http://skallywags.club/img/logo.png' alt='logo' height='150' width='150'/><hr>";
        }
        else
        {
            $path = "<img src='".$path."' alt='logo' height='150' width='150'/><hr>";
        }
        return $path;
    }


    /*
   $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                        $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
                        $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP passwor
//                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                        $mail->isHTML(true);
                        //Recipients
                        $mail->setFrom($this->email, $this->first_name . " " . $this->last_name);
                        $mail->addAddress("mbamber1986@gmail.com","Martin Bamber");
                        //Content
                        if (empty($this->club)) {
                            $mail->Subject = $this->subject;
                        } else {
                            $mail->Subject = "Club($this->club) : " . $this->subject;
                        }

                        $mail->Body = "<img src='http://skallywags.club/img/logo.png' alt='logo' height='150' width='150'/><hr>";
                        $mail->Body .= "Name : $this->first_name" . " $this->last_name <br><br>";
                        $mail->Body .= "Current Club :" . $this->club . "<br><br>";
                        $mail->Body .= "Message : <br><br>" . $this->message;

                        $mail->send();
                        redirect($url->make("contact-sent"));
                    } catch (Exception $e) {
                        $this->error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
     */



}