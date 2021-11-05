<?php


namespace App\Http\Models;

use App\Http\Controllers\Controller;

class User extends Controller
{

    public function csrf()
    {
        return $this->hasOne(Token::class);
    }

    public function TwoFactorAuth()
    {
        return $this->hasOne(TwoFactorAuth::class);
    }

    public function Profile()
    {
        return $this->hasOne(Profile::class);
    }

    public  function Article()
    {
        return $this->hasMany(Article::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }


    public function image()
    {
        return $this->hasOne(Image::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function Fullname($user_id)
    {
        $settings = UserSettings::where("user_id",$user_id)->get()->first();
        if($settings->display_full_name == 0)
        {
            return ucfirst($settings->user->username);
        }
        else
        {
            return ucfirst($settings->user->Profile->first_name) . " " .ucfirst($settings->user->Profile->last_name);
        }
    }

    public function PasswordRequests()
    {
       return $this->hasOne(PasswordRequest::class);
    }


}