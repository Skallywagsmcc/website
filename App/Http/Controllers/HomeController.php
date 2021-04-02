<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.Homepage.index",["url"=>$url]);
    }


}