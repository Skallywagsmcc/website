<?php

use App\Http\Models\User;
use mbamber1986\Authclient\Auth;


function im_admin()
{
    $auth = new mbamber1986\AuthClient\Auth();
        if (User::where("id", $auth->id())->where("is_admin", 1)->count() == 1) {
            return true;
        } else {
            return false;
        }
}

?>