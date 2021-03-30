<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        echo BladeEngine::View("Pages.Frontend.Homepage.index",["url"=>$url]);
    }


}