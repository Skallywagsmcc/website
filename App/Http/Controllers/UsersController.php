<?php


namespace App\Http\Controllers;
use App\Http\Functions\TemplateEngine;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;


class UsersController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.index",$url);
    }


}