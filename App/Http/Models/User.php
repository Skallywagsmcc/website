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



}