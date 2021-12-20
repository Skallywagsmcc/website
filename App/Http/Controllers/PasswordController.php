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

/*Account Status codes

0 : account disabled will rely on token table
1 : banned : Banned needs to link to banning table
2 : active
*/

//        TODO Implement Recaptcha


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
            $request->expires = $now->modify("+30 mins")->format("Y-m-d H:i:s");
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
                $mail->setFrom("no-reply@skallywags.club", "no reply");
                $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Password Reset Request";
                $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                $mail->Body .= "Sorry to hear you have forgot your password, Please find below a link to continue this process <br><br>";
                $mail->Body .= "<a href='" . $_ENV['DOMAIN'] . $url->make("password-reset.retrieve", ["id"=>$request->id,"hex"=>$request->hex])."'>Click Here</a> <br><br>";
                $mail->Body .= "If this was Not you, Please <a href='" . $_ENV['DOMAIN'] . $url->make("password-reset.index")."'>Click Here</a>";
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


    public function cancelrequest(Url $url, Validate $validate)
    {
        $user = User::where("email", $validate->Post("email"))->get()->first();
        $requests = $user->PasswordRequests()->where("user_id", $user->id)->get();
        if($user->disable == 1)
        {
            $key = md5($validate->RequestHexKey());
            echo "Profile found";
            $user->exchange_key = $key;
            $user->email;
            $user->save();

            if ($requests->count() == 1) {
//            Send email to email address with a new Exchange code;
//                This needs to be dont tomorrow  01/06/2021

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
                    $mail->setFrom("mail@skallywags.club", "Password Manager");
                    $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $user->username . "Here is your Password Cancellation Request";
                    $mail->Body = "<div><img src='" . $_ENV['LOGO'] . "' alt='logo' height='100' width='100'/></div>";
                    $mail->Body .= "Hello " . $user->Profile->first_name . "<hr>";
                    $mail->Body .= "Here is your Password Cancellation Request Code Please copy and paste this into your browser screen: $key  <br><br>";
                    $mail->Body .= "if you have forgot your password : <a href='" . $_ENV['DOMAIN'].$url->make("password-reset.index")."'>Click this link</a> <br><br>";

                    $mail->Body .= $_ENV['DOMAIN'] . " &copy; " . date("Y") . " | <a href='" . $url->make("terms.home") . "'>Terms and conditions</a>";
                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

//                Emd Email
//no longer matches the request

                echo TemplateEngine::View("Pages.Frontend.PasswordReset.cancel", ["url" => $url, "message" => $message, "id" => $user->id]);
                exit();
            } else {
                $message = "Request not found";
            }
        }
        else {
            $message = "This Account has login privleges";
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url, "message" => $message]);
    }


    public function cancelStore(Url $url, Validate $validate)
    {
        $id = $validate->Post("id");
        $key = $validate->Post("exchange_key");
        if (empty($key)) {
            $message = "Exchange Key Value Cannot be left empty";
        } else {
            $user = User::where("id", $id)->get()->first();
            $requests = $user->PasswordRequests()->where("user_id", $user->id);
            if($user->disable == 1) {
                if ($requests->count() == 1) {
                    if ($user->exchange_key == $key) {
                        $user->exchange_key = null;
                        $user->disable = 0;
                        $user->save();
                        $requests->delete();
                        redirect($url->make("login"));
                    } else {
                        $message = "Sorry the Exchange Key You have entered is not valid";
                    }
                } else {
                    $message = "Password Request cannot be found";
                }
            }
            else
            {
                $message = "No Action is needed";
            }
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.cancel", ["url" => $url, "message" => $message, "id" => $id, "key" => $key]);
    }


    public function retrieve($id, $hex, Url $url)
    {
//Step 1 : get values from $id  and $hex and verify the user exisits

        $request = PasswordRequest::where(["id" => $id, "hex" => $hex])->get();
        if ($request->count() == 1) {
            $expired = false;
            $request = $request->first();
//            get CUrrent time and expiration

            $now = new DateTime();

            $expires = DateTime::createFromFormat("Y-m-d H:i:s", $request->expires)->format("Y-m-d H:i:s");
            $now = $now->setTimezone(new DateTimeZone("Europe/london"))->format("Y-m-d H:i:s");

            if ($now >= $expires) {
                $expired = true;
                $message = "Your Reset Request has expired";
            } elseif ($request->exchange_key != $request->user->exchange_key) {
                $expired = true;
                $message = "Sorry Your Exchange Key Doesnt match";
            } else {
                $expired = false;
                $message = "Reset your Password";
            }
        } else {
            $expired = true;
            $message = "We cannot find the user Account";
        }

        echo TemplateEngine::View("Pages.Frontend.PasswordReset.new", ["url" => $url, "id" => $id, "hex" => $hex, "message" => $message, "expired" => $expired]);

//    Step 2 load template for the form with Password fields

    }


    public function store(Url $url, Validate $validate)
    {

        $request = PasswordRequest::where("id", $validate->Post("id"))->where("hex", $validate->Post("hex"));
        if ($request->get()->count() == 1) {
            $id = $validate->Post("id");
            $hex = $validate->Post("hex");
            $expired = false;
            $validate->HasStrongPassword($validate->Post("password"));
//            Rotate through Requirements
            if (empty($validate->Post("password")) || empty($validate->Post("confirm"))) {
                $message = "Password Fields cannot be empty";
            }
//            elseif(Validate::$ValidPassword == false)
//            {
//                $message = "Password Does not Match our Strong Password Requirements PLease see our terms and conditions for more details";
//            }
            elseif ($validate->Post("password") != $validate->Post("confirm")) {
                $message = "Password and password confirmation do not match";

            } else {
//                $message = "success";
                $request = $request->first();
                $user = User::find($request->get()->first()->user_id);
                $user->password = password_hash($validate->Post("password"), PASSWORD_DEFAULT);
                $user->disable = 0;
                $user->exchange_key = null;
                $user->save();
                $request->delete();
                redirect($url->make("login"));
            }
        } else {
            $message = "Sorry that user cannot be found or the request has expired";
        }
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.new", ["url" => $url, "id" => $id, "hex" => $hex, "message" => $message]);
    }
}