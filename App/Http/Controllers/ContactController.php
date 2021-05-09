<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\SiteSettings;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ContactController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.contact",["url"=>$url]);
    }

    public  function store(Url $url, Validate $validate)
    {
        $settings = SiteSettings::find(1);
        $contact = new Auth();

        $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
                $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP password
//                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom("mbamber1986@gmail.com", $validate->Post("first_name") . " " . $validate->Post("last_name"));
                $mail->addAddress("mail@skallywags.club", "Mail");     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $validate->Post("subject");
                $mail->Body = "<img src='http://skallywags.club/img/logo.png' alt='logo'/>";
                $mail->Body .= $validate->Post("message");

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    }


}