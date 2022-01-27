<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


use App\Http\Models\User;
use mbamber1986\Authclient\Auth;

trait Authentication
{

    public function isGuest()
    {
        if ($this->VerifyLogin()) {
            return true;
        } else {
            return false;
        }
    }

//    this will verifu
    public function VerifyLogin()
    {
        $auth = new Auth();
        return $auth->id();
    }

//    this will allow the user to verify is the user is an admin on the fly
    public function isAdmin()
    {
        if($this->findUser()->is_admin == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findUser()
    {
        $user = User::where("id", $this->VerifyLogin())->get();
        if ($user->count() == 1) {
            $user = $user->first();
        } else {
            return false;
        }
        return $user;
    }

}