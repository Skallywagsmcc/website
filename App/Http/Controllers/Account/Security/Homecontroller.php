<<<<<<< HEAD
<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class Homecontroller
{

    public function index(Url $url,Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.index",["url"=>$url,"auth"=>$auth]);
    }

=======
<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use MiladRahimi\PhpRouter\Url;

class Homecontroller
{

    public function index(Url $url,Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.index",["url"=>$url,"auth"=>$auth]);
    }

>>>>>>> ebb3196e763824bca8c2fb04034d29fda885ee22
}