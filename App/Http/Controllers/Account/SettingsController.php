<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\Image;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use MiladRahimi\PhpRouter\Url;

class SettingsController
{

    public function index(Url $url,Auth $auth)
    {
//        This needs to be builts a middleware to setup profile information that hasnt been created
        if(UserSettings::where("user_id",$auth->id())->count()==0)
        {
            $settings = new UserSettings();
            $settings->user_id = $auth->id();
            $settings->save();
        }
            $user = User::find($auth->id());

        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Settings.index",["user"=>$user,"url"=>$url]);
    }

    public function show()
    {

    }


    public function create()
    {

    }

    public function store(Url $url,Validate $validate, Csrf $csrf,Auth $auth)
    {
        if ($csrf->Verify() == true) {
            $settings = UserSettings::where("user_id", $auth->id())->get();
            if ($settings->count() == 1) {
                $settings = $settings->first();
                $settings->two_factor_auth = $validate->Required("twofactorauth")->Post();
                $settings->display_full_name = $validate->Required("fullname")->Post();
                $settings->display_dob = $validate->Required("display_dob")->Post();
                $settings->display_email = $validate->Required("email")->Post();
                $settings->save();
                redirect($url->make("account.home"));
            }   else
            {
                echo "Sorry it seems the settings have not be created for the user";
            }
        }

    }


}