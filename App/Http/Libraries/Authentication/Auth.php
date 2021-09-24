<!---->
<?php
//
//
//namespace App\Http\Libraries\Authentication;
//
//
//use App\Http\Functions\TemplateEngine;
//use App\Http\Models\User;
//use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//
//class Auth
//{
//
//    public static $id;
//    public static $ValidateEmail;
//    public static $errmessage;
//    public static $ResetApproved;
//    public static $redirect;
//    protected static $withuser;
//    protected static $withemail;
//    protected static $withpassword;
//    protected static $username;
//
////Get post requests
//    protected static $email;
//    protected static $password;
//    protected $remember;
//
//

//    protected static function bin2hexGen()
//    {
//        return base64_encode(bin2hex(random_bytes(32)));
//    }
//
//    public function ObtainKey()
//    {
//        return bin2hex(random_bytes(32));
//    }
//
//    public static function getusername()
//    {
//
//        $user = User::find(self::Auth()::id());
//        return $user->username;
//
//    }
//
//    public function RequirePassword($password)
//    {
////        this will be used to update destructive settings such as  user or admin settings.
//        $user = User::where("id", $this->id())->get();
//        if ($user->count() == 1) {
//            if (empty($password) || !password_verify($password, $user->first()->password)) {
//                return false;
//            } else {
//                return true;
//            }
//        }
//    }
//
//    public static function id()
//    {
//        if((isset($_COOKIE['token'])) || (isset($_SESSION['token'])))
//        {
//            $user = User::where("token",$_SESSION['token'])->orwhere("token",$_COOKIE['token'])->get();
//            if($user->count() == 1)
//            {
//                $user = $user->first();
//                return $user->id;
//            }
//        }
//    }
//
//    public static function Auth()
//    {
////    Set all the values to
//        self::$withuser = false;
//        self::$withemail = false;
//        self::$withpassword = false;
//        return new static();
//    }
//
//    public function SendEmail($email, $name, $subject, $page, $array)
//    {
////        Must have page and name otherwise nothing
//        if (!empty($page) || !empty($array)) {
//            $mail = new PHPMailer(true);
//            try {
//                //Server settings
//                $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
//                $mail->isSMTP();                                            //Send using SMTP
//                $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
//                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
//                $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
//                $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP password
////                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//                $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//
//                //Recipients
//                $mail->setFrom($email, $first_name . " " . $last_name);
//                $mail->addAddress("mail@skallywags.club", "Mail");     //Add a recipient
//
//
//                //Content
//                $mail->isHTML(true);                                  //Set email format to HTML
//                $mail->Subject = $subject;
//                $mail->Body = "hello";
//
//                $mail->send();
//                echo 'Message has been sent';
//            } catch (Exception $e) {
//                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//            }
//        }
//    }
//
//    public function WithUser($username)
//    {
//        self::$withuser = true;
//        self::$username = $username;
//        return $this;
//    }
////    end registration script
//
////    Login section
//
//    public function WithEmail($email)
//    {
//        self::$withemail = true;
//        self::$email = $email;
//        return $this;
//    }
//
//    public function WithPassword($password)
//    {
//        self::$withpassword = true;
//        self::$password = password_hash($password, PASSWORD_DEFAULT);
//        return $this;
//    }
//
//
//}