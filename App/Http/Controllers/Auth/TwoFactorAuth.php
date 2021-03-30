<?php


namespace App\Http\Controllers\Auth;

use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class TwoFactorAuth
{
    public function index(Url $url)
    {
        echo BladeEngine::View("Pages.Auth.Login.TwoFactorAuth",["url"=>$url]);


    }

    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->code = $validate->Required("code")->Post();
        Authenticate::InsertTwoFactorAuth($user->code);
    }


}