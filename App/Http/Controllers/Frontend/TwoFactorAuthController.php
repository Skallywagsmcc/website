<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\TwoFactorAuth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class TwoFactorAuthController
{
//Homepage
    public function index(Url $url)
    {
        $user = User::find(Auth::id());
        if (isset($_SESSION['tfa_approved']) && ($_SESSION['tfa_approved'] == 0)) {
//            display the Blade controller to send the email
            echo TemplateEngine::View("Pages.Frontend.Tfa.index", ["url" => $url, "user" => $user]);
        } else {
            redirect($url->make("homepage"));
        }

    }


    public function create(Url $url, Csrf $csrf, Validate $validate)
    {
//this section will get the data from the emails and match it request a code.


        $user = User::find(Auth::id());
        $tfa = TwoFactorAuth::where("user_id",Auth::id())->get();
        $tfa->count() == 0 ? $tfa = new TwoFactorAuth() : $tfa = $tfa->first();
        $hex = $validate->RequestHexKey();
        $tfa->user_id = Auth::id();
        $tfa->hex = $hex;
        $tfa->code = rand(100000, 999999);
        $tfa->save();

//        $mail = new PHPMailer(true);
//        try {
//            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
//            $mail->isSMTP();                                            //Send using SMTP
//            $mail->Host = $_ENV['SMTP_HOST'];          //Set the SMTP server to send through
//            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
//            $mail->Username = $_ENV['SMTP_USERNAME'];    //SMTP username
//            $mail->Password = $_ENV['SMTP_PASSWORD'];    //SMTP password
////                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//            $mail->Port = 587;        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//
//            //Recipients
//            $mail->addAddress($user->email, $user->Profile->first_name . " " . $user->Profile->last_name);
//            $mail->setFrom("mail@skallywags.club", "Mail");     //Add a recipient
//
//
//            //Content
//            $mail->isHTML(true);                                  //Set email format to HTML
//            $mail->Subject = "your two Factor authenticatiom";
//            $mail->Body = "hello here is your code $code";
//
//            $mail->send();
//            echo 'Message has been sent';
//        } catch (Exception $e) {
//            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//        }
        redirect($url->make("tfa.retrieve", ["id" => $user->id, "hex" => $tfa->hex]));

    }

    public function show($id, $hex, Csrf $csrf, Validate $validate, Url $url)
    {
        echo "Page found with hex $hex";
        echo TemplateEngine::View("Pages.Frontend.Tfa.code", ["url" => $url]);
    }


    public function store(Url $url, Validate $validate, Csrf $csrf)
    {

        if ($csrf->Verify() == true) {
            $code = $validate->Required("code")->Post();
            $user = User::find(Auth::id());
            $tfa = $user->TwoFactorAuth()->where("user_id", Auth::id())->get();
            if (Validate::Array_Count(Validate::$values) == false) {
                $error = "Please check the Required fields (Code)";
            } else {
                if ($code == $tfa->first()->code) {
//               check if the code has expired
                    $_SESSION['tfa_approved'] = 1;
                    $user->TwoFactorAuth()->where("id", $tfa->first()->id)->delete();
                    redirect($url->make("profile.home", ["username", $user->first()->username]));
                } else {
                    $error = "that code is not valid";
                }
            }
            echo TemplateEngine::View("Pages.Frontend.Tfa.code", ["url" => $url, "errormessage" => $error]);
        }
    }

}