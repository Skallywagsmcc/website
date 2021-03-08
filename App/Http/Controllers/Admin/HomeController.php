<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;

class HomeController
{
    public function index()
    {
        echo BladeEngine::View("Pages.Admin.index");
    }
}