<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Emails\Authentication;
use App\Http\Models\User;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Authenticate
{

//    Valid Valies
    public static $id;
    public static $ValidateEmail;
    public static $errmessage;
    public static $ResetApproved;
    public static $redirect;
    private static $withuser;
    private static $withemail;
    private static $withpassword;
    private static $username;

//Get post requests
    private static $email;
    private static $password;
    private $remmeber;

//end requests

    public function __construct()
    {
        $this->remmeber = 0;
    }

//    Pre validation

    public static function ValidateEmail($email)
    {
        return User::where("email", $email)->get()->count();
    }


    public static function ValidateUser($username)
    {
        return User::where("username", $username)->get()->count();
    }


//End Prevalidation

// Registration

    public static function Auth()
    {
//    Set all the values to
        self::$withuser = false;
        self::$withemail = false;
        self::$withpassword = false;
        return new static();
    }

    public static function InsertTwoFactorAuth($code)
    {

        isset($_SESSION['id']) ? $auth = $_SESSION['id'] : $auth = $_COOKIE['id'];
        $user = User::where("id", $auth)->get()->first();
        if ($code == $user->TwoFactorAuth->code) {
            Sessions::Create("RequireTfa", false);
            header("location:/profile");
            echo  "Approved";
        } else {
            self::$errmessage = "The Code you entered is incorrect";
        }


    }

    public function SendEmail($email,$name,$subject,$page,$array)
    {
//        Must have page and name otherwise nothing
        if(!empty($page) || !empty($array))
        {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $_ENV['SMTP_USERNAME'];                     //SMTP username
                $mail->Password   = $_ENV['SMTP_PASSWORD'];                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = $_ENV['SMTP_PORT'];                             //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('No-reply@skallywagsmcc.club',"no Reply");
                $mail->addAddress($email,$name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = BladeEngine::View($page,$array);

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    }

    public function Redirect($value)
    {
        if (Authenticate::$redirect == true) {
            header("location:$value");
        } else {
        }
    }

    public function ResetPassword($id, $hex)
    {

        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            if ($user->TwoFactorAuth->hex == $hex) {
                self::$ResetApproved = true;
            }
        } else {
            echo "no user found";
        }
        return $this;
    }

    public function WithUser($username)
    {
        self::$withuser = true;
        self::$username = $username;
        return $this;
    }



//    end registration script


//    Login section

    public function WithEmail($email)
    {
        self::$withemail = true;
        self::$email = $email;
        return $this;
    }

    public function WithPassword($password)
    {

        self::$withpassword = true;
        self::$password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function Register($redirect = null)
    {
        $user = new User();
        if (self::$withuser == true) {
            $user->username = self::$username;
        }
        if (self::$withemail == true) {
            $user->email = self::$email;
        }
        if (self::$withpassword == true) {
            $user->password = self::$password;
        }
        $user->two_factor_auth = 1;
        $user->save();
//        if ((is_null($redirect)) || ($redirect == null)) {
//            header("location:/auth/register/success");
//        } else {
//            header("location:$redirect");
//        }
        return $this;
    }

    public function AllowRemember($remmember)
    {
        $this->remmeber = $remmember;
        return $this;
    }

    public function Login($username = null, $password = null)
    {
        echo $_SESSION['id'];
        $users = User::where("username", $username)->orwhere("email", $username)->get();
        $user = $users->first();
        if ($users->count() == 1) {

//            Check if the password matches the database password

            if ($this->PasswordVerify($password, $user->password)) {
//                Generate the cookies;
                if ($this->remmeber == 1) {
                    Sessions::Destroy("id");
                    Cookies::Create("id", $user->id)->Days(7)->Http(true)->Save();
                } else {
//                We Instantiate session id
                    Cookies::Destroy("id")->Days(365)->Save();
                    Sessions::Create("id", $user->id);
                }
//               Generate CSRF Token
                Csrf::GenerateToken($user->id);

//                Send The TFA Login to the email;
//                if($user->two_factor_auth == 1)
//                {
//                    $results = TwoFactorAuth::CountAuths($user->id);
//                    $results == 0 ? TwoFactorAuth::GenerateCode($user->id) : TwoFactorAuth::UpdateTwoFactorAuth($user->TwoFactorAuth->id);
//                    Authentication::TwoFactor($user->email, TwoFactorAuth::__getCode());
//                    Sessions::Create("RequireTfa",true);
//                    Authenticate::$redirect = true;
//                }
//                else
//                {
//                    Sessions::Create("RequireTfa",false);
//                    self::$redirect = true;
//                }
                redirect("/profile");
                Authenticate::$redirect == true;

            } else {
                self::$errmessage = "Whoa!! :( it Looks Like the Password you typed doesnt match our Records";
            }
//            Return user doesnt exisit
        } else {
            self::$errmessage = "Sorry the Detiails you are looking for cannot be found in our records";
        }

        return $this;

    }

//    end login script

//    Reset Passwords

    public function PasswordVerify($password, $hash = null)
    {
        if (is_null($hash)) {
            $hash = self::$password;
        }
        return password_verify($password, $hash);
    }
}