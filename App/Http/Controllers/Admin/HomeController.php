<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url,Validate $validate)
    {
        echo TemplateEngine::View("Pages.Admin.index",["url"=>$url]);
    }
}