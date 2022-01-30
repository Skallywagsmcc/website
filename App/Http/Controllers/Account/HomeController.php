<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Home",["url"=>$url]);
    }
}