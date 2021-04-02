<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Admin.index",["url"=>$url]);
    }
}