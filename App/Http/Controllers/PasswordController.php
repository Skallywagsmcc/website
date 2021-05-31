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

    public function index(Url $url)
    {


//        Index page for the Password Reset
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url]);
    }

    public function request(Url $url, Validate $validate)
    {

        $user = User::where("email", $validate->Post("email"))->get();
        if ($user->count() == 1) {
            $now = new DateTime();
            $now = $now->setTimezone(new DateTimeZone('Europe/london'));
            $exchange_key = md5($validate->RequestHexKey());
            $user = $user->first();
            $password = $user->PasswordRequests($user->id)->where("user_id", $user->id)->get();
            $password->count() == 0 ? $request = new PasswordRequest() : $request = PasswordRequest::find($user->PasswordRequests->id);
            $request->user_id = $user->id;
            $request->hex = $validate->RequestHexKey();
            $request->exchange_key = $exchange_key;
            $request->expires = $now->modify("+30 mins")->format("Y-m-d h:i:s");
            $request->save();


//            Email to the user the reset Link
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
                $mail->Port = $_ENV["SMTP_PORT"];        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom("mail@skallywags.club", "Password Reset");
                $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "You have requested a new Password reset";
                $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                $mail->Body .= "Sorry to hear you have forgot your password, Please find below a link to continue this process <br><br>";
                $mail->Body .= "<a href='".$_ENV['DOMAIN']."/auth/reset-password/retrieve/" . $request->user_id . "/" . $request->hex . "'>Click Here</a> <br><br>";
                $mail->Body .= "If this was Not you, Please <a href='".$_ENV['DOMAIN']."/auth/reset-password/reactivate/" . $request->id . "/" . $request->hex . "'>Click Here</a>";
                $mail->Body .= "to ReActivate your login and use your original password  as we disable it during te password reset Process as stated in our terms and conditions<hr>";
                $mail->Body .= $_ENV['DOMAIN'] . " &copy; " . date("Y") . " | <a href='" . $url->make("terms.home") . "'>Terms and conditions</a>";
                $mail->send();
                redirect($url->make("login"));
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

//            Disable Login
            $user = User::find($user->id);
            $user->exchange_key = $exchange_key;
            $user->disable = 1;
            $user->save();
        } else {
            $link = $url->make("contact-us");
            $message = "We cannot Send you a recovery email as we cannot find the account on our system \n";
            $message .= "Please check the details if the issue persists please <a href=" . $link . ">contact us </a> \n";
            echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url, "message" => $message]);
        }

    }


    public function retrieve($id, $hex, Url $url)
    {
//Step 1 : get values from $id  and $hex and verify the user exisits

        $request = PasswordRequest::where(["user_id" => $id, "hex" => $hex])->get();
        if ($request->count() == 1) {
            echo "we found a user";
            $request = $request->first();
            $now = new DateTime();
            $expires = DateTime::createFromFormat("Y-m-d h:i:s",$request->expires)->format("Y-m-d H:i:s");
            $now = $now->setTimezone(new DateTimeZone("Europe/london"))->format("Y-m-d H:i:s");
            if($request->user->exchange->key != $request->exchange_key)
            {
                $message = "the Exchange Key Does not match";
            }
            if ($now >= $expires) {
                $message =  "Sorry the request has expired";
                $expired = true;
            }
        } else {
            echo "No user found";
            $message = "this Request has Expired";
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.new", ["url" => $url, "id" => $id, "hex" => $hex,"message"=>$message,"expired"=>$expired]);

//    Step 2 load template for the form with Password fields

    }


    public function store(Url $url, Validate $validate)
    {

        $request = PasswordRequest::where("id", $validate->Post("id"))->where("hex", $validate->Post("hex"));
        if ($request->get()->count() == 1) {

            if (!empty($validate->Post("password")) || !empty($validate->Post("confirm")) && $validate->Post("password") === $validate->Post("confirm")) {
                $validate->HasStrongPassword($validate->Post("password"));
                if ($validate::$ValidPassword == true) {
                    $user = User::find($request->get()->first()->user_id);
                    $user->password = password_hash($validate->Post("password"), PASSWORD_DEFAULT);
                    $user->disable = 0;
                    $user->exchange_key = null;
                    $user->save();
                    $request->delete();
                    redirect($url->make("login"));
                } else {
                    echo "Password is not strong enough";
                }
            } else {
                echo "the Password does not match";
            }
        } else {
            echo "user Not found or the Request has expired";
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.new", ["url" => $url, "id" => $id, "hex" => $hex,"message"=>$message]);
    }
}