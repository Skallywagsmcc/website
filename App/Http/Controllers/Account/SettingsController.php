<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\Image;
use App\Http\Models\User;
use App\Http\Models\UserSettings;

class SettingsController
{

    public function index()
    {
        $user = User::find(Auth::id());
        echo BladeEngine::View("Pages.Frontend.Account.Settings",["user"=>$user]);
    }

    public function show()
    {

    }


    public function create()
    {

    }

    public function store()
    {
        $validate = new Validate();
        $settings = UserSettings::where("user_id",Auth::id())->get();
        if($settings->count() == 1)
        {
            $settings = $settings->first();
            $settings->two_factor_auth = $validate->Required("twofactorauth")->Post();
            $settings->display_full_name = $validate->Required("fullname")->Post();
            $settings->save();
        }
    }


}