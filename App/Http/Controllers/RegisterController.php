<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Profile;
use App\Http\Models\SiteSettings;
use App\Http\Models\Token;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class RegisterController
{

    public $username;
    public $email;
    public $password;
    public $confirm;
    public $first_name;
    public $last_name;
    public $status;  //private or public
    public $token;
    public $showform;
    public $request; // true or false
    public $error;
    public $required;
    public $expired;
    private $entity_name;

    public function __construct(Validate $validate)
    {

        $this->entity_name = "register_request";
        $this->status = false;
        $this->showform = false;
        $this->expired = false;
        $this->entity_name = "request/registration";


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->username = $validate->Post("username");
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
            $this->confirm = $validate->Post("confirm");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->token = $validate->Post("token_hex");
            $this->token_key = $validate->Post("token_key");
        }

    }

    public function index(Url $url, $token_hex = null)
    {

//        Variables
//        Add Lockout
        if ($settings = $this->SiteSettings()->where("open_registration", 0)->count() == 1) {
            $this->request = Token::where("entity_name", $this->entity_name)->where("token_hex", $token_hex)->get();
            if (($this->request->count() == 1)) {
                if(date("Y-m-d H:i:s",strtotime($this->request->first()->expires)) < date("Y-m-d H:i:s"))
                    {
                        $this->error = "This Request has expired";
                        $this->showform = false;
                    }
                else
                {
                    $this->request = $this->request->first();
                    $this->token = $this->request->token_hex;
                    $this->showform = true;
                }
            }
            else {      $this->showform = false;
                if($this->request->first()->token_hex != $token_hex)
                {
                    $this->error = "Token Is Invalid";
                }
                else
                {
                    $this->error = "Registration is closed";
                }

            }
        } else {
            if ($token_hex != null) {
                $this->error = "An Error Occurred Invalid Token";
            } else {
                $this->showform = true;
            }

        }

        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings" => $this->SiteSettings()->get(), "request" => $this]);
    }

    public function SiteSettings()
    {
        return SiteSettings::where("id", 1);
    }

    public function Store(Url $url, Validate $validate)
    {
//


        if ((!is_null($this->token)) && (!is_null($this->token_key))) {
            $settings = $this->SiteSettings()->where("open_registration", 0)->count();
            $this->request = Token::where("entity_name", $this->entity_name)->where("token_hex", $this->token)->where("token_key", $this->token_key);
            if (($settings == 1) && ($this->request->count() == 1)) {

                if (date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($this->request->get()->first()->expires))) {
                    $this->expired = true;
                } else {
                    $this->status = true;
                }

            } else {
                $this->status = false;
            }
        } else {
            $this->status = false;
        }
        $this->showform = true;
        if (!is_null($this->token)) {
            $required = ["username", "email", "password", "confirm", "first_name", "last_name", "token_key"];
        } else {
            $required = ["username", "email", "password", "confirm", "first_name", "last_name"];
        }
        $validate->AddRequired($required);
        if ($this->expired == true) {
            $this->error = "This request has expired";
            $this->showform = false;
        } elseif ($validate->allowed() == false) {
            $this->error = "Invalid fields";
            $this->required = str_replace("_", " ", $validate->is_required);
        } elseif (filter_var("$this->username", FILTER_VALIDATE_EMAIL)) {
            $this->error = "Username Cannot be in the form of an email address";
        }
        elseif ($this->password != $this->confirm) {
            $this->error = "Password and confirmation password must match";
        } elseif ($validate->HasStrongPassword($this->password) == false) {
            $this->error = "Password does not match our Secure Password Policy";
        } elseif ($validate->Recaptcha(1, 0.5, "register") == false) {
            $error = $validate->captchaerror;
            $this->showform = true;
        } else {
            if((User::where("email",$this->email)->count() )== 1 && ($this->request->count()==0))
            {
                $this->error = "Email ALready exists in our database";
            }
            elseif (User::where("username", $this->username)->count() == 1) {
                $this->error = "Username already Exists";
            }
            elseif($this->request->first()->token_key != $this->token_key)
            {
                $this->error = "The Token key your entered is invalid";

            }
            else {
                $this->status == true ? $user = User::find($this->request->first()->User->id) : $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->password = password_hash($this->password, PASSWORD_DEFAULT);
                $user->status = 1;
                $user->save();


                $this->status == true ? $profile = Profile::where("user_id", $user->id)->get()->first() : $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->first_name = $this->first_name;
                $profile->last_name = $this->last_name;
                $profile->save();


                $this->status == true ? $usersettings = UserSettings::where("user_id", $user->id)->get()->first() : $usersettings = new UserSettings();
//                    Add user settings here
                $usersettings->user_id = $user->id;
                $usersettings->save();


//                    TODO Need to sort our and do a count with Profle and user settings.
                $this->status == true ? $this->request->delete() : false;

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
                    $mail->addAddress($user->email, $user->Profile->first_name . " ". $user->Profile->last_name);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = "Your Account is created";
                    $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                    $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                    $mail->Body .= "Welcome to the Skallywags, Your account has been created, all that is left is to simply activate your account <hr>";
                    $mail->Body .= " <a href='" . $_ENV['DOMAIN'] . "/Activate'>Click Here</a> to activate your account <br><br>";
                    $mail->Body .= "Have Any questions please feel free to <a href='" . $_ENV['DOMAIN'] . $url->make("contact-us") . "'>Click here</a> to contact us";
                    $mail->send();
                    redirect($url->make("login"));
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }
        }

        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "request" => $this]);
    }


}
