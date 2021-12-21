<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\PasswordRequest;
use App\Http\Models\User;
use Carbon\Traits\Date;
use DateTime;
use DateTimeZone;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class PasswordController
{

    public $token_hex;
    public $user_id;
    public $token_key;
    public $entity_id;
    public $entity_name;
    public $expires;
    public $request;
    public $error;
    public $required;
    public $status;

    public $password;
    public $email;
    public $confirm;

    public function __construct(Validate $validate)
    {
        $this->entity_name = "password_request";
        $this->status = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
            $this->confirm = $validate->Post("confirm");
            $this->token_hex = $validate->Post("token_hex");
            $this->token_key = $validate->Post("token_key");

        }
    }

    public function index(Url $url)
    {
//this will link with store()
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url, "value" => $this]);
    }

    public function request(Url $url, $token_hex = null)
    {
//        this page will link with update()
        $this->token_hex = $token_hex;
//        Index page for the Password Reset

        $this->request = PasswordRequest::where("entity_name", $this->entity_name)->where("token_hex", $this->token_hex)->get();
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.request", ["url" => $url, "token_hex" => $token_hex, "value" => $this]);
    }

    public function store(Url $url, Validate $validate)
    {

        $validate->AddRequired(["email"]);

        if($validate->Allowed()==false)
        {
            $this->error = "Missing fields";
            $this->required = $validate->is_required;
        }
        elseif($validate->Recaptcha(1,0.5,"password_request") == false)
        {
            $this->error = $validate->captchaerror;
        }
        else {
//        check user account exisit;
                $user = User::where("email", $this->email)->get();#
                if ($user->count() == 1) {
                    $user = $user->first();
//            look for the requests via user_id
                    $request = PasswordRequest::where("user_id", $user->id)->get();

                    if ($request->count() == 0) {
                        $request = new PasswordRequest();
                    } else {
                        $request = $request->first();
                    }

                    $request->user_id = $user->id;
                    $request->entity_name = $this->entity_name;
                    $request->token_hex = $validate->RequestHexKey();
                    $request->token_key = rand(000001, 999999);
                    $request->expires = date("Y-m-d H:i:s", strtotime("+30 Mins"));
                    $request->save();


//            Email

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
                        $mail->setFrom("no-reply@skallywags.club", "no reply");
                        $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "Password Recovery : A new Request has been made";
                        $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                        $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                        $mail->Body .= "Sorry your having issue's in regards to accessing your account Please find below the step by step instructions on how to reset your password. <hr>";
                        $mail->Body .= "Step 1: Copy this token_key <strong>". $request->token_key."</strong><br>";
                        $mail->Body .= "Step 2: Click on Reset Request link provided below <br>";
                        $mail->Body .= "Step 3: Create and confirm your new password <br>";
                        $mail->Body .= "Step 4: Paste your token key into the box token_key input field <br>";
                        $mail->Body .= "Step 5: Submit the form and your password will be reset. <hr>";
                        $mail->Body .= "Your reset Request : <a href='" . $_ENV['DOMAIN'] . $url->make("passwordreset.request", ["token_hex" => $request->token_hex]) . "'>Click Here</a> <br><br>";
                        $mail->Body .= "If your think this was sent in error please disregard this email and continue to <a href='" . $_ENV['DOMAIN']. $url->make("login") . "'>Login to Your account</a> <hr>";
                        $mail->Body .= "If your encounter any issue resetting your password please <a href='".$_ENV['DOMAIN'].$url->make("contact-us")."'>Click here</a> to contact us";
                        $mail->send();
                        $this->status = true;
//                redirect($url->make("login"));
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

//            End Email

            } else {
                $this->error = "no user found";
            }
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url, "value" => $this]);
    }


    public function update(Url $url, Validate $validate)
    {
        $request = PasswordRequest::where("entity_name",$this->entity_name)->where("token_hex",$this->token_hex)->where("token_key",$this->token_key)->get();
        if($request->count()==1)
        {
            echo "requests found with token key " .$this->token_key;
        }
        else
        {
            echo "No Request found";
        }
    }
}