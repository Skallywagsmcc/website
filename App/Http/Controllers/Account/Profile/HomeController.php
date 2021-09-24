<?php


namespace App\Http\Controllers\Account\Profile;

use App\Http\Functions\TemplateEngine;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.index",["url"=>$url]);
    }

}