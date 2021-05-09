<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Authentication\TwoFactorAuth;
use App\Http\Models\User;
use Jenssegers\Blade\Blade;
use MiladRahimi\PhpRouter\Url;

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


    public function show(Url $url,Csrf $csrf)
    {
//this section will get the data from the emails and match it request a code.


        $user = User::find(Auth::id());
        $tfa = $user->TwoFactorAuth()->where("user_id", Auth::id())->get();
        $tfa->count() == 0 ? TwoFactorAuth::GenerateCode(Auth::id()) : TwoFactorAuth::UpdateTwoFactorAuth( $tfa->first()->id);
        $code = TwoFactorAuth::__getCode();
        Auth::auth()->SendEmail($user->email,"".$user->Profile->first_name."".$user->Profile->last_name."","Your two Factor Authentication code","Emails.Tfa",["url"=>$url,"user",$user,"tfa"=>$tfa->first(),"code"=>$code]);
        echo TemplateEngine::View("Pages.Frontend.Tfa.code", ["url" => $url, "user" => $user]);
    }

    public function store(Url $url,Validate $validate ,Csrf $csrf)
    {

        if($csrf->Verify() == true) {
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
                    redirect($url->make("profile.home", ["username", $user->username]));
                } else {
                    $error = "that code is not valid";
                }
            }
            echo TemplateEngine::View("Pages.Frontend.Tfa.code", ["url" => $url, "errormessage" => $error]);
        }
    }

}