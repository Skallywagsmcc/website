<?php

use App\Http\Controllers\Account\AboutController;
use App\Http\Controllers\Account\BasicInfoController;
use App\Http\Controllers\Account\EmailController;
use App\Http\Controllers\Account\PasswordController;
use App\Http\Controllers\Account\ProfilePictureController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\TwoFactorAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\CommentsController;
use App\Http\Controllers\Profile\DisplayController;
use App\Http\Controllers\Profile\ImageController;
use App\Http\Controllers\SearchController;
use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\SqlInstaller\Base;
use App\Http\Middleware;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;


//Instantiate

$router = Router::create();
// Index controller

$router->group(["prefix"=>"/api"],function(Router $router)
{
    $router->get("/?",function()
    {
       echo "Hello";
    });
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish(TemplateEngine::View("Templates.PageNotFound"));
}
