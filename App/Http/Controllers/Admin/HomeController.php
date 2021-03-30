<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url)
    {
        echo BladeEngine::View("Pages.Admin.index",["url"=>$url]);
    }
}