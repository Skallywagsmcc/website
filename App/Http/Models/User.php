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

    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    public function Article()
    {
        return $this->hasOne(Article::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function Members()
    {
        return $this->hasOne(Member::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function terms()
    {
        return $this->hasMany(Terms::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function PasswordRequests()
    {
       return $this->hasOne(PasswordRequest::class);
    }


}