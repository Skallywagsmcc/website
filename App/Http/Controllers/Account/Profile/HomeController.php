<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url, Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.index",["url"=>$url]);
    }

}