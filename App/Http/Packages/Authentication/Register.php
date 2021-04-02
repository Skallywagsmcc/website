<?php


namespace App\Http\Packages\Authentication;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\User;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Register
{
    public static $id;
    public static $ValidEmail;
    public static $ValidPassword;
    public static $ValidUser;

    protected static $username;
    protected static $password;
    protected static $confirm;
    protected static $email;

    public static function ValidateEmail($email)
    {
//        We will validate the email address  here
        $users = User::where("email", $email)->get();
        if ($users->count() == 1) {
            self::$ValidEmail = true;
        } else {
            self::$ValidEmail == false;
//           Save Data to database
            $user = new User();
            $user->tfa = true;
            $user->email = $email;
            $user->status = "pending";
            $user->expires = time() + 3600;
            $user->save();
            self::$email = $email;
            self::$id = $user->id;
        }
        return new static();
    }

    public function EmailConfirmation()
    {
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


//Load Composer's autoloader

//Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $_SERVER["SMTP_HOST"];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_SERVER["SMTP_USERNAME"];                  //SMTP username
            $mail->Password   = $_SERVER['SMTP_PASSWORD'];           //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('No-Reply@skallywags.club', 'No reply');
            $mail->addAddress(self::$email);     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

//    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'This account has been created';
            $mail->Body    = TemplateEngine::View("Templates.newuser",["email"=>self::$email]);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
return $this;
    }




    public function GeneratePassword($password, $id = null )
    {
        if ((is_null($id)) || ($id == null)) {
            $id = self::$id;
        }

        if(self::$ValidEmail == 1)
        {
            header("location:/auth/register");
        }
        elseif(self::$ValidEmail == false)
        {
            $user = User::find($id);
            $user->password = $password;
            $user->save();
        }

        return $this;
    }

    public function Redirect($location)
    {
        return header("location: $location");
    }


}