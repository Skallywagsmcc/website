<?php


namespace App\Http\Controllers\Auth;


use MiladRahimi\PhpRouter\Url;

class PasswordResetController
{

    public function index(Url $url)
    {
//        Reset template goes here
    }

    public function store($code, $id,Url $url)
    {
        /* the Store data goes here
        step 1 : Request Cpde via the $code variable,
        step 2 : update the password on the Users table using $id;
        $step 3 : delete the request if the if the request isnt deleted after 7 days let the cron job take care of it
        */
    }


}