<?php

use App\Http\Controllers\Account\AboutController;
use App\Http\Controllers\Account\BasicInfoController;
use App\Http\Controllers\Account\EmailController;
use App\Http\Controllers\Account\PasswordController;
use App\Http\Controllers\Account\ProfilePictureController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\CommentsController;
use App\Http\Controllers\Profile\DisplayController;
use App\Http\Controllers\Profile\ImageController;
use App\Http\Libraries\SqlInstaller\Base;
use App\Http\Middleware;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;


//Instantiate

$router = Router::create();
// Index controller
$router->get("/", [HomeController::class, 'index'], "homepage");
$router->get("/install",[Base::class,'index']);

$router->group(["prefix"=>"/search"],function(Router $router)
{
    $router->get("/?",[\App\Http\Controllers\SearchController::class,'index'],"search.home");
    $router->get("/view",[\App\Http\Controllers\SearchController::class,'view'],"search.view");
});

$router->group(["prefix"=>"/secure/tfa","middleware" => [Middleware\RequireLogin::class]],function (Router $router)
{
   $router->get("/?",[\App\Http\Controllers\Frontend\TwoFactorAuthController::class,"index"],"tfa.index");
   $router->post("/retrieve",[\App\Http\Controllers\Frontend\TwoFactorAuthController::class,"show"],"tfa.get");
   $router->post("/save",[\App\Http\Controllers\Frontend\TwoFactorAuthController::class,"store"],"tfa.save");
});


$router->group(["prefix"=>"/auth"],function(Router $router){
    $router->get("/login", [LoginController::class, 'index'], "login");
    $router->post("/login/success", [LoginController::class, 'store'], "login.store");
    $router->get("/logout", [LoginController::class, 'logout'], "logout");
});

$router->group(["prefix" => "/page/{category}"], function (Router $router) {
    $router->get("/?", [PageController::class, 'index'], "pages.home");
    $router->get("/search/keyword", [PageController::class, 'search'], "pages.search");
    $router->get("/{slug}", [PageController::class, 'view'], "pages.view");
});


$router->group(["prefix" => "/admin","middleware" => [Middleware\RequireLogin::class,Middleware\TwoFactorAuth::class]], function (Router $router) {

//Users
    $router->group(["prefix" => "/users"], function (Router $router) {
        $router->get("/?", [UsersController::class, 'index'], "admin.users.home");
        $router->get("/new", [UsersController::class, 'create'], "admin.users.create");
        $router->post("/new", [UsersController::class, 'store'], "admin.users.store");
        $router->get("/edit/{id}/{username}", [UsersController::class, 'edit'], "admin.users.edit");
        $router->post("/edit/save", [UsersController::class, 'update'], "admin.users.update");
        $router->get("/delete/{id}", [UsersController::class, 'delete'], "admin.users.delete");
    });

    $router->group(["prefix" => "/categories"], function (Router $router) {
        $router->get("/?", [CategoriesController::class, 'index'], "admin.category.home");
        $router->get("/new", [CategoriesController::class, 'create'], "admin.category.create");
        $router->post("/new/store", [CategoriesController::class, 'store'], "admin.category.store");
        $router->get("/delete/{id}", [CategoriesController::class, 'delete'], "admin.category.delete");
    });

    $router->group(["prefix" => "/pages"], function (Router $router) {
        $router->get("/?", [PagesController::class, 'index'], "admin.pages.home");
        $router->get("/new", [PagesController::class, 'create'], "admin.pages.new");
        $router->post("/new", [PagesController::class, 'store'], "admin.pages.store");
        $router->get("/edit/{slug}/{id}", [PagesController::class, 'edit'], "admin.pages.edit");
        $router->post("/edit", [PagesController::class, 'update'], "admin.pages.update");
        $router->get("/edit", [PagesController::class, 'delete'], "admin.pages.delete");
    });

    $router->get("/?",function()
    {
        echo "Admin panel";
    },"admin.home");

});


$router->group(["prefix" => "/profile/{username}"], function (Router $router) {
    $router->group(["prefix" => "/gallery"], function (Router $router) {
        $router->get("/?", [DisplayController::class, 'gallery'], "gallery.home");
        $router->get("/image/{id}", [DisplayController::class, 'DisplayImage'], "gallery.image.view");
        $router->post("/comments/add", [CommentsController::class, 'store'], "gallery.comment.add");
        $router->post("/upload", [ImageController::class, 'store'], "gallery.store");
        $router->get("/comment/delete/{id}", [CommentsController::class, 'delete'], "gallery.comment.delete");
        $router->get("/image/delete/{id}", [ImageController::class, 'delete'], "gallery.image.delete");
    });

    $router->get("/?", [DisplayController::class, 'index'], "profile.home");
});


$router->group(["prefix" => "/account", "middleware" => [Middleware\RequireLogin::class,Middleware\TwoFactorAuth::class]], function (Router $router) {
    $router->get("/?", [AccountController::class, 'index'], "account.home");
    $router->get("/edit/basic", [BasicInfoController::class, 'index'], "account.basic.home");
    $router->post("/edit/basic", [BasicInfoController::class, 'store'], "account.basic.store");
    $router->get("/ICE/about", [AboutController::class, 'index'], "account.about.home");
    $router->post("/edit/about", [AboutController::class, 'store'], "account.about.store");
    $router->get("/edit/picture", [ProfilePictureController::class, 'index'], "account.picture.home");
    $router->post("/edit/picture", [ProfilePictureController::class, 'store'], "account.picture.store");
    $router->get("/edit/password", [PasswordController::class, 'index'], "account.password.home");
    $router->post("/edit/password", [PasswordController::class, 'store'], "account.password.store");
    $router->get("/edit/email", [EmailController::class, 'index'], "account.email.home");
    $router->post("/edit/email", [EmailController::class, 'store'], "account.email.store");
    $router->get("/edit/settings", [SettingsController::class, 'index'], "account.settings.home");
    $router->post("/edit/settings", [SettingsController::class, 'store'], "account.settings.store");
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
