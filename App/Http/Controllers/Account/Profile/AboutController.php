<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;
use Symfony\Contracts\Service\Attribute\Required;

class AboutController
{


    public function index(Url $url)
    {
        $user = User::find(Auth::id());
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.About", ["user" => $user,"url"=>$url]);
    }

    public function store(Url $url,Validate $validate,Csrf $csrf)
    {
        if($csrf->Verify()==true)
        {
            $user = User::find(Auth::id());
            $profile = $user->Profile()->where("user_id", Auth::id())->get();
            $profile->count() == 0 ? $profile = new Profile() : $profile = $profile->first();
            $profile->about = $validate->Post("about");

//        leave this here
            if(Auth::Auth()->RequirePassword($validate->Required("password")->Post()) == true)
            {

                $profile->save();
                redirect($url->make("backend.home"));


            }
            else
            {
                Validate::$error = " password empty or does not match";
            }


            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.About", ["url"=>$url,"user" => $user, "error" => Validate::$error, "values" => Validate::$values]);
        }

    }


}