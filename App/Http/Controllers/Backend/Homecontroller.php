<?php


namespace App\Http\Controllers\Backend;


use App\Http\Functions\TemplateEngine;
use MiladRahimi\PhpRouter\Url;

class Homecontroller
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Home",["url"=>$url]);
    }
}