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
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->subject = $validate->Post("subject");
            $this->message = $validate->Post("message");

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

        $settings = $this->SiteSettings()->first();
        $address = Address::where("contactus",1)->get();
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url,"requests" => $this,"address"=>$address]);
    }

    public function store(Url $url, Validate $validate,Mailer $mailer)
    {

            $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
            $recaptcha_secret = $_SERVER['GRK'];
            $recaptcha_response = $_POST['g-recaptcha-response'];

            $recaptcha = file_get_contents($recaptcha_url. '?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
            $recaptcha = json_decode($recaptcha,true);


        if(($this->settings->count() == 1 ) && ($this->settings->first()->lock_subumssions == 1))
        {
            $this->error = "Submissions Are locked";
        }
        else {
            $validate->AddRequired(["first_name","last_name","message","subject"]);

            if($this->clubmember == 1)
            {
                $validate->AddRequired("club");
            }

            if ($validate->Allowed() == false) {
                $this->error = "The Following Missing fields are required";
                $this->rmf = $validate->is_required;
            } else {
                if(($recaptcha['success'] == 1) && ($recaptcha['score'] >= 0.5) && ($recaptcha['action'] == "contactus")){
                    $mail = new PHPMailer();
                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;         //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                        $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
                        $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP passwor
//                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                        $mail->isHTML(true);
                        //Recipients
                        $mail->setFrom('no-reply@skallywags.club', 'Martin Bamber');
                        $mail->addAddress("mail@skallywags.club","skallywags Mail");
                        $mail->addReplyTo($this->email,$this->first_name." ". $this->last_name);
                        //Content
                            $mail->Subject = $this->subject;

//                   completed:      Manage the logo
                        $mail->Body = $mailer->logo();
////
//////                      todo  Setup First and last name
                        $mail->Body .= "You have recieved an message from : ".$this->first_name . " ". $this->last_name . "<br><hr>";

//                TODO   topic : general question or membership Question

                        $mail->Body .= "Reason for contact : " . $this->subject . "<br><br>";
                        $mail->Body .= "Are they already in a club : ". $this->clubmember = 0 ? "No":"Yes" . "<br><br>";
                        $mail->Body .= $this->clubmember = 1 ? "Clubname : " . $this->club."" : "";
                        $mail->Body .= "<br><br>";

//                        Submit message
                        $mail->Body .= "Message from ". $this->first_name . "<br><br>" . $this->message;

                        $mail->send();
                        redirect($url->make("contact-sent"));
                    } catch (Exception $e) {
                        $this->error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $this->error = "Sorry we was unable to verify your request! Please try again";
                }
            }
        }
        echo TemplateEngine::View("Pages.Frontend.Contact.index", ["url" => $url,"requests" => $this, "error" => $this->error, "rmf"=>$this->rmf]);
    }

    public function sent(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.Contact.sent",["url"=>$url]);

    }

}