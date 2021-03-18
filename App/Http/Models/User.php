<?php


namespace App\Http\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as Capsule;

class User extends Controller
{

    public function Token()
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
        return $this->hasOne(Page::class);
    }

    public function gallery()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(ImageComment::class);
    }


}