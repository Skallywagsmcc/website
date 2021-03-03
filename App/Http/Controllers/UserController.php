<?php


namespace App\Http\Controllers;
use App\Http\Functions\BladeEngine;
use App\Http\Models\User;


class UserController
{

    public function index()
    {
        echo BladeEngine::View("Pages.index");
    }


}