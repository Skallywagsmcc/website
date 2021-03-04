<?php


namespace App\Http\Controllers;


use App\Http\Libraries\Authentication\TwoFactorAuth;

class ProfileController
{

    public function index()
    {
        TwoFactorAuth::CheckStatus();
        echo "Profile page";
    }


}