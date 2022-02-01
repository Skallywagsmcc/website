<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\ActivityLog;
use App\Http\traits\Activity_log;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public $activity;


    use Activity_log;

    public function index(Url $url,Auth $auth)
    {
       $this->activity =  $this->UserActivity();
        echo TemplateEngine::View("Pages.Backend.UserCp.Home",["url"=>$url,"request"=>$this]);
    }
}