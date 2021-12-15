<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Address;
use App\Http\Models\SiteSettings;
use Illuminate\Support\Facades\Mail;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Plugins\Mailer\Mailer;

class ContactController
{

    public $sum1;
    public $sum2;
    public $email;
    public $first_name;
    public $last_name;
    public $club;
    public $subject;
    public $message;
    public $total;
    public $rmf;
    public $error;
    public $clubmember;
    public $settings;
    public $address;


    public function __construct(Validate $validate)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->email = $validate->Post("email");
            $this->sum1 = $validate->Post("sum1");
            $this->sum2 = $validate->Post("sum2");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->subject = $validate->Post("subject");
            $this->message = $validate->Post("message");
            $this->total = $validate->Post("total");
            $this->club = $validate->Post("club");
            $this->clubmember = $validate->Post("clubmember");

        }
        $this->settings = $this->SiteSettings();
        $this->address = explode(",",$this->settings->first()->contact_address);

    }

    public function matchsum($v1,$v2)
    {
        if($this->total == $v1 + $v2)
        {;
            return true;
        }
        else
        {
            return false;
        }
    }

    public function SiteSettings()
    {
        return SiteSettings::where("id",1)->get();
    }

    public function index(Url $url,Validate $validate,Mailer $mailer)
    {
        $sum1 = rand(1, 50);
        $sum2 = rand(1, 50);
        $settings = $this->SiteSettings()->first();
        $address = Address::where("contactus",1)->get();
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url, "sum1" => $sum1, "sum2" => $sum2, "requests" => $this,"address"=>$address]);
    }

    public function store(Url $url, Validate $validate,Mailer $mailer)
    {
        $sum1 = rand(1, 50);
        $sum2 = rand(1, 50);
        if(($this->settings->count() == 1 ) && ($this->settings->first()->lock_subumssions == 1))
        {
            $this->error = "Submissions Are locked";
        }
        else {
            $validate->AddRequired(["first_name","last_name","message","subject","total"]);

            if($this->clubmember == 1)
            {
                $validate->AddRequired("club");
            }

            if ($validate->Allowed() == false) {
                $this->error = "The Following Missing fields are required";
                $this->rmf = $validate->is_required;
            } else {
                if($this->matchsum($this->sum1,$this->sum2) == true) {
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
                            $mail->Subject = $this->subject;


//                   completed:      Manage the logo
                        $mail->Body = $mailer->logo("http://skallywags.club/img/bike.jpg");
//
////                      todo  Setup First and last name
                        $mail->Body .= "Fullname :". $this->first_name . " $this->last_name <br><br>";
//
////                   TODO   topic : general question or membership Question
//
////                    TODO  Define that the user is in a club
///
                        if($this->clubmember == 1)
                        {
                            $mail->Body .= "I am currently a member of the club :  " . $this->club . "<br><br>";
                        }

//                        Submit message
                        $mail->Body .= "Message : <br><br>" . $this->message;
                        $mail->send();
                        redirect($url->make("contact-sent"));
                    } catch (Exception $e) {
                        $this->error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $this->error = "The Answer to the maths question is not correct";
                }
            }
        }
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url, "sum1" => $sum1, "sum2" => $sum2,"requests" => $this, "error" => $this->error, "rmf"=>$this->rmf]);
    }

    public function sent(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.Contact.sent",["url"=>$url]);

    }

}