<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class TfaController
{

    public function index(Url $url,Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.tfa",["url"=>$url,"auth"=>$auth]);
    }

}