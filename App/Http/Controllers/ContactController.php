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

    public function SiteSettings()
    {
        return SiteSettings::where("id",1);
    }

    public function index(Url $url,Validate $validate)
    {
        $sum1 = rand(1,50);
        $sum2 = rand(1,50);
        $settings = $this->SiteSettings()->first();
        if($settings->lock_submissions == 1)
        {
            $error = "This Form is locked";
        }
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url,"sum1"=>$sum1,"sum2"=>$sum2,"settings"=>$settings,"error"=>$error]);
    }

    public function store(Url $url, Validate $validate)
    {
        if($this->SiteSettings()->where("lock_submissions",1)->get()->count() == 1)
        {
            $error = "This form has been locked and conot be sumitted";
        }
        else {

            $sum1 = rand(1, 50);
            $sum2 = rand(1, 50);
            $email = $validate->Required("email")->Post();
            $first_name = $validate->Required("first_name")->Post();
            $last_name = $validate->Required("last_name")->Post();
            $club = $validate->Post("club");

            if (empty($club)) {
                $club = "N/a";
            }

            $subject = $validate->Required("subject")->Post();
            $message = $validate->Required("message")->Post();
            $answer1 = $validate->Required("sum1")->Post();
            $answer2 = $validate->Required("sum2")->Post();
            $total = $validate->Required("total")->Post();

            if ($validate->Allowed() == false) {
                $error = "The Following Missing fields are required";
                $rmf = $validate->is_required;
            } else {
                if($total == $answer1 + $answer2) {
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
                        $mail->setFrom($email, $first_name . " " . $last_name);
                        $mail->addAddress("mail@skallywags.club", "Mail");     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        if (empty($club)) {
                            $mail->Subject = $subject;
                        } else {
                            $mail->Subject = "Club($club) : " . $subject;
                        }

                        $mail->Body = "<img src='http://skallywags.club/img/logo.png' alt='logo' height='150' width='150'/><hr>";
                        $mail->Body .= "Name : $first_name" . " $last_name <br><br>";
                        $mail->Body .= "Current Club :" . $club . "<br><br>";
                        $mail->Body .= "Message : <br><br>" . $message;

                        $mail->send();
                        redirect($url->make("contact-sent"));
                    } catch (Exception $e) {
                        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $error = "The Answer to the maths question is not correct";
                }
            }
        }
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url, "error" => $error,"rmf"=>$rmf, "validate"=>$validate,"sum1"=>$sum1,"sum2"=>$sum2]);

    }

    public function sent(Url $url)
    {

        echo TemplateEngine::View("Pages.Frontend.Contact.sent", ["url" => $url]);
    }

}