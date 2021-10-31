
<?php


namespace App\Http\Controllers\Account\ImageManager;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url, Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.ImageManager.index", ["url" => $url, "auth" => $auth]);
    }
}