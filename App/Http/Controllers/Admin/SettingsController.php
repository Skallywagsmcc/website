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

    public function Store(Url $url, Validate $validate,Csrf $csrf)
    {
        if($csrf->Verify() == true)
        {
            $user = User::where("id", Auth::id())->get();

            if ($user->count() == 1) {


                if (password_verify($validate->Post("password"), $user->first()->password)) {
                    SiteSettings::all()->count() == 0 ? $settings = new SiteSettings() : $settings = SiteSettings::find(1);

                    echo $settings;
                    $settings->email = $validate->Required("email")->Post();
                    $settings->comments = $validate->Post("comments");
                    $settings->login = $validate->Post("login");
                    $settings->registration = $validate->Post("registration");
                    $settings->discord = $validate->Post("discord");
                    $settings->facebook = $validate->Post("facebook");
                    $settings->twitter = $validate->Post("twitter");
                    $settings->linkedin = $validate->Post("linkedin");
                    if (Validate::Array_Count($validate::$values) == false) {
                        $error = "An Email Address is required";
                    } else {
                        $settings->save();
                        redirect($url->make("admin.settings"));
                    }

                } else {
                    $error = "Sorry the password does not match the database (Access restricted)";
                }
            } else {
                redirect($url->make("homepage"));
            }
        }

        echo TemplateEngine::View("Pages.Backend.settings",["url"=>$url,"error"=>$error,"user"=>$user->first(),"settings"=>$settings]);
    }
}