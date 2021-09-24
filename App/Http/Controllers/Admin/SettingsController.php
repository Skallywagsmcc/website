<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\SiteSettings;
use App\Http\Models\Article;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class SettingsController
{

    public function index(Url $url)
    {
        $settings = SiteSettings::find(1);
        echo TemplateEngine::View("Pages.Backend.settings",["url"=>$url,"settings"=>$settings]);
    }

    public function store(Url $url, Validate $validate,Csrf $csrf)
    {
        if($csrf->Verify() == true)
        {
            $user = User::where("id", Auth::id())->get();

            if ($user->count() == 1) {
                if (password_verify($validate->Post("password"), $user->first()->password)) {
                    SiteSettings::all()->count() == 0 ? $settings = new SiteSettings() : $settings = SiteSettings::find(1);


                    $settings->contact_email = $validate->Post("email");
                    $settings->maintainence_status = $validate->Post("maintainence_status");

                        $settings->save();
                        redirect($url->make("auth.admin.settings.home"));

                } else {
                    $error = "Sorry the password does not match the database (Access restricted)";
                }
            } else {
                redirect($url->make("homepage"));
            }
        }

        echo TemplateEngine::View("Pages.Backend.settings",["url"=>$url,"error"=>$error,"user"=>$user->first(),"settings"=>$settings,"error"=>$error]);
    }
}