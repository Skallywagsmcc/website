<?php


namespace App\Http\Controllers;
use App\Http\Functions\BladeEngine;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;


class UserController
{

    public function index(Url $url)
    {
        echo BladeEngine::View("Pages.index",$url);
    }


}