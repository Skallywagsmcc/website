<?php


namespace App\Http\Controllers\Auth;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;

use App\Http\Functions\BladeEngine;
use App\Http\Models\User;

class TwoFactorAuth
{

    public function index()
    {
        echo BladeEngine::View("Pages.Auth.Login.TwoFactorAuth");
    }

    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->code = $validate->Required("code")->Post();
        Authenticate::InsertTwoFactorAuth($user->code);
    }


}