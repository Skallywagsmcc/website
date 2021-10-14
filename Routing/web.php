<?php

use App\Http\Controllers\Account\ImageManager\FeatueredImageController;
use App\Http\Controllers\Account\Profile\AboutController;
use App\Http\Controllers\Account\Profile\BasicInfoController;
use App\Http\Controllers\Account\Profile\ProfilePictureController;
use App\Http\Controllers\Account\Security\EmailController;
use App\Http\Controllers\Account\Security\PasswordController;
use App\Http\Controllers\Account\Security\TfaController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\ArticlesController as AdminArticles;
use App\Http\Controllers\Admin\ChartersController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\TwoFactorAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Members;
use App\Http\Controllers\Profile\GalleryController;
use App\Http\Controllers\SearchController;
use App\Http\Libraries\SqlInstaller\Base;
use App\Http\Middleware;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;


//Instantiate

$router = Router::create();
//Frontend
$router->get("/sql/install", [Base::class, 'index']);

$router->group(["prefix"=>"","middleware"=>[Middleware\Installer::class,Middleware\ServiceMode::class]],function (Router $router)
{
    $router->get("/contact-us", [ContactController::class, 'index'], "contact-us");
    $router->post("/contact-us", [ContactController::class, 'store'], "contact-store");
    $router->get("/contact-us/thank-you", [ContactController::class, 'sent'], "contact-sent");


    $router->group(["prefix" => "/search"], function (Router $router) {
        $router->get("/?", [SearchController::class, 'index'], "search.home");
        $router->get("/view", [SearchController::class, 'view'], "search.view");
        $router->get("/view/{type}", [SearchController::class, 'viewtype'], "search.view.type");
    });

    $router->group(["prefix" => "/members"], function (Router $router) {
        $router->get("/?", [Members::class, "index"], "members.home");
    });

    $router->group(["prefix" => "/secure/tfa", "middleware" => [Middleware\Installer::class,Middleware\UserLogin::class]], function (Router $router) {
        $router->get("/?", [TwoFactorAuthController::class, "index"], "tfa.index");
        $router->post("/request", [TwoFactorAuthController::class, "create"], "tfa.get");
        $router->get("/request/user/{id}/token/{hex}", [TwoFactorAuthController::class, "show"], "tfa.retrieve");
        $router->post("/save", [TwoFactorAuthController::class, "store"], "tfa.save");
    });

    $router->group(["prefix" => "/charters"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\ChartersController::class, 'index'], "charters.home");
        $router->get("/view/{slug}", [\App\Http\Controllers\ChartersController::class, 'show'], "charters.view");
    });

    $router->group(["prefix" => "/terms"], function (Router $router) {
        $router->get("/?", function () {
            echo "terms";
        }, "terms.home");
    });

    $router->group(["prefix" => "/events"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\EventsController::class, 'index'], "events.home");
        $router->get("/view/{slug}", [\App\Http\Controllers\EventsController::class, 'show'], "events.view");
        $router->get("/view/year/{year}", [\App\Http\Controllers\EventsController::class, 'view'], "events.view.year");
    });


    $router->group(["prefix" => "/articles"], function (Router $router) {
        $router->get("/?", [ArticlesController::class, 'index'], "articles.home");
        $router->any("/by-year/{year}", [ArticlesController::class, 'year'], "articles.year");
        $router->get("/{slug}", [ArticlesController::class, 'view'], "articles.view");
    });

    $router->group(["prefix" => "/profile"], function (Router $router) {
        $router->group(["prefix" => "/{username}"], function (Router $router) {
            $router->get("/?", [\App\Http\Controllers\Profile\HomeController::class, 'show'], "profile.view");
            $router->group(["prefix" => "/gallery"], function (Router $router) {
                $router->get("/?", [GalleryController::class, 'index'], "profile.gallery.home");
                $router->get("/image/{id}", [GalleryController::class, 'show'], "profile.gallery.view");
            });
        });
        $router->get("/?", [\App\Http\Controllers\Profile\HomeController::class, 'index'], "profile.home");
    });

    $router->get("/", [HomeController::class, 'index'], "homepage");
});

//Authenitcation
$router->group(["prefix" => "/auth","middleware"=>[Middleware\Installer::class]], function (Router $router) {

//    Must be available for login of administators
    $router->get("/?", [LoginController::class, 'index'], "login");
    $router->get("/login", [LoginController::class, 'index'], "login");
    $router->post("/login/success", [LoginController::class, 'store'], "login.store");
    $router->get("/register",[\App\Http\Controllers\RegisterController::class,'index'],"register");
    $router->post("/register/store",[\App\Http\Controllers\RegisterController::class,'store'],"register.store");
    $router->get("/logout", [LoginController::class, 'logout'], "logout");

    $router->group(["prefix"=>"/tfa","middleware"=>[Middleware\Installer::class,Middleware\ServiceMode::class]],function (Router $router)
    {
        $router->get("/?",function ()
        {
            echo "hello";
        },"tfa.home");
    });

    $router->group(["prefix"=>"/reset-password","middleware"=>[Middleware\Installer::class,Middleware\ServiceMode::class]],function (Router $router)
    {
        $router->get("/?", [\App\Http\Controllers\PasswordController::class, "index"], "password-reset.index");
        $router->post("/request", [\App\Http\Controllers\PasswordController::class, "request"], "password-reset.request");
        $router->get("/retrieve/{id}/{hex}", [\App\Http\Controllers\PasswordController::class, "retrieve"], "password-reset.retrieve");
        $router->post("/store", [\App\Http\Controllers\PasswordController::class, "store"], "password-reset.store");
        $router->post("/cancel", [\App\Http\Controllers\PasswordController::class, "cancelrequest"], "password.cancel.index");
        $router->post("cancel/store", [\App\Http\Controllers\PasswordController::class, "cancelStore"], "password.cancel.store");
    });

});
//Api Requests go here

//Admin
$router->group(["prefix" => "/user/control/admin","middleware"=>[Middleware\Installer::class,Middleware\ServiceMode::class,Middleware\AdminLogin::class]], function (Router $router) {
//    Events manager controlled by Admins
    $router->group(["prefix" => "/events"], function (Router $router) {
        $router->get("/?", [EventsController::class, "index"], "auth.admin.events.home");
        $router->get("/create", [EventsController::class, "create"], "auth.admin.events.new");
        $router->post("/store", [EventsController::class, "store"], "auth.admin.events.store");
        $router->get("/edit/{id}", [EventsController::class, "edit"], "auth.admin.events.edit");
        $router->post("/update", [EventsController::class, "update"], "auth.admin.events.update");
        $router->post("/delete",[EventsController::class,"delete"],"auth.admin.events.delete");

    });

/*User manager Controlled By Admins*/
    $router->group(["prefix" => "/images"], function (Router $router) {
        $router->get("/?", [ImageController::class, "index"], "auth.admin.images.home");
        $router->get("/search", [ImageController::class, "search"], "auth.admin.images.search");
        $router->get("/view/{username}/{id}", [ImageController::class, "view"], "admin.images.manage");
        $router->get("/search", [ImageController::class, "search"], "auth.admin.images.search");
        $router->get("/view/delete/{user_id}/{id}", [ImageController::class, "delete"], "auth.admin.images.delete");
    });

//    Featured Images Controlled by Admins
    $router->group(["prefix" => "/featured"], function (Router $router) {
        $router->get("/?", [FeaturedController::class, "index"], "auth.admin.featured.home");
        $router->get("/manage/review/{id}", [FeaturedController::class, "review"], "auth.admin.featured.review");
        $router->get("/manage/request/{id}/status/{status}", [FeaturedController::class, "manage"], "auth.admin.featured.manage");
        $router->get("/manage/delete/{id}", [FeaturedController::class, "delete"], "auth.admin.featured.delete");

    });
//    Settings Controlled by Admins
    $router->get("/settings", [\App\Http\Controllers\Admin\SettingsController::class, "index"], "auth.admin.settings.home");
    $router->post("/settings/save", [\App\Http\Controllers\Admin\SettingsController::class, "store"], "auth.admin.settings.store");

    //    Users Images Controlled by Admins
    $router->group(["prefix" => "/users"], function (Router $router) {
        $router->get("/?", [UsersController::class, "index"], "auth.admin.users.home");
        $router->get("/new", [UsersController::class, "create"], "auth.admin.users.new");
        $router->get("/edit/{id}/{username}", [UsersController::class, "edit"], "auth.admin.users.edit");
        $router->post("/store", [UsersController::class, "store"], "auth.admin.users.store");
        $router->post("/update", [UsersController::class, "update"], "auth.admin.users.update");
        $router->get("/search", [UsersController::class, "search"], "auth.admin.users.search");
    });

    $router->group(["prefix" => "/articles"], function (Router $router) {
        $router->get("/?", [AdminArticles::class, "index"], "auth.admin.articles.home");
        $router->get("/search", [AdminArticles::class, "search"], "auth.admin.articles.search");
        $router->get("/new", [AdminArticles::class, 'create'], "auth.admin.articles.new");
        $router->post("/new/save", [AdminArticles::class, 'store'], "auth.admin.articles.store");
        $router->get("/edit/{slug}/{id}", [AdminArticles::class, 'edit'], "auth.admin.articles.edit");
        $router->post("/edit/{slug}/{id}", [AdminArticles::class, 'update'], "auth.admin.articles.update");
        $router->get("/delete/{id}", [AdminArticles::class, 'delete'], "auth.admin.articles.delete");
//            $router->post("/delete/image", [AdminArticles::class, 'deleteimages'], "auth.admin.articles.images.delete");

    });

//    Charter manager Controlled by Admins
    $router->group(["prefix" => "/charters"], function (Router $router) {
        $router->get("/?", [ChartersController::class, 'index'], "auth.admin.charters.home");
        $router->get("/view/{id}", [ChartersController::class, 'view'], "auth.admin.charters.view");
        $router->post("/default/store",[ChartersController::class,'SetDefault'],'auth.admin.charters.default');
        $router->get("/new", [ChartersController::class, 'create'], "auth.admin.charters.create");
        $router->post("/create/save", [ChartersController::class, 'store'], "auth.admin.charters.store");
        $router->get("/edit/{id}", [ChartersController::class, 'edit'], "auth.admin.charters.edit");
        $router->post("/update/save", [ChartersController::class, 'update'], "auth.admin.charters.update");
        $router->get("/delete/{id}", [ChartersController::class, 'delete'], "auth.admin.charters.delete");
    });

//Admin Homepage
    $router->get("/?", [\App\Http\Controllers\Admin\HomeController::class, "index"], "auth.admin.home");
});

//Account
$router->group(["prefix" => "/user","middleware"=>[Middleware\Installer::class,Middleware\ServiceMode::class,Middleware\UserLogin::class]], function (Router $router) {

    $router->group(["prefix" => "/account"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\Account\Profile\HomeController::class, 'index'], "account.home");
        $router->get("/edit/basic", [BasicInfoController::class, 'index'], "account.basic.home");
        $router->post("/edit/basic", [BasicInfoController::class, 'store'], "account.basic.store");
        $router->get("/ICE/about", [AboutController::class, 'index'], "account.about.home");
        $router->post("/edit/about", [AboutController::class, 'store'], "account.about.store");
        $router->get("/edit/picture", [ProfilePictureController::class, 'index'], "account.picture.home");
        $router->post("/edit/picture", [ProfilePictureController::class, 'store'], "account.picture.store");
        $router->get("/edit/settings", [SettingsController::class, 'index'], "account.settings.home");
        $router->post("/edit/settings", [SettingsController::class, 'store'], "account.settings.store");
    });

//   Manage security Settings
    $router->group(["prefix" => "/security"], function (Router $router) {
        $router->get("/manage/password", [PasswordController::class, 'index'], "security.password.home");
        $router->post("/manage/password/store", [PasswordController::class, 'store'], "security.password.store");
        $router->get("/manage/email", [EmailController::class, 'index'], "security.email.home");
        $router->post("/manage/email/store", [EmailController::class, 'store'], "security.email.store");
        $router->get("/manage/two-factor-authentication", [TfaController::class, 'index'], "security.tfa.home");
        $router->get("/?", [\App\Http\Controllers\Account\Security\Homecontroller::class, "index"], "security.home");
    });

//    Manage Image Manager

    $router->group(["prefix" => "/images/manage"], function (Router $router) {
//        Crud
        $router->get("/?", [\App\Http\Controllers\Account\ImageManager\ImageController::class, "index"], "images.gallery.home");
        $router->get("/add", [\App\Http\Controllers\Account\ImageManager\ImageController::class, "create"], "images.gallery.add");
        $router->get("/update/{id}", [\App\Http\Controllers\Account\ImageManager\ImageController::class, "edit"], "images.gallery.update");
        $router->get("/delete/{id}", [\App\Http\Controllers\Account\ImageManager\ImageController::class, "delete"], "images.gallery.delete");
//        Requests
//        Post requests
        $router->post("/store", [\App\Http\Controllers\Account\ImageManager\ImageController::class, "store"], "images.gallery.store");
        $router->get("/featured/requests", [FeatueredImageController::class, "index"], "images.featured.home");
        $router->get("/featured/requests/add/{id}", [FeatueredImageController::class, "add"], "images.featured.add");
        $router->get("/featured/requests/delete/{id}", [FeatueredImageController::class, "delete"], "images.featured.delete");
    });

    $router->group(["prefix"=>"/settings"],function (Router $router){
       $router->get("/?",\App\Http\Models\SiteSettings::class,"index","auth.admin.settings.home");
       $router->post("/store",\App\Http\Models\SiteSettings::class,"index","auth.admin.settings.store");
    });
//    Load Base Page
    $router->get("/?", [\App\Http\Controllers\Backend\Homecontroller::class, "index"], "backend.home");
    $router->get("/whats-new", [\App\Http\Controllers\Backend\Homecontroller::class, "index"], "backend.whatsnew");
    $router->get("/activity", [\App\Http\Controllers\Backend\Homecontroller::class, "index"], "backend.activity");
});


$router->group(["prefix"=>"/install"],function(Router $router)
{
    $router->get("/?",[\App\Http\Controllers\InstallerController::class,"index"],"installer.home");


    $router->group(["prefix"=>"/{key}"],function(Router $router)
    {
        $router->post("/?",[\App\Http\Controllers\InstallerController::class,"termsstore"],"installer.terms.store");
        $router->get("/profile",[\App\Http\Controllers\InstallerController::class,"profile"],'installer.profile.home');
        $router->post("/profile/save",[\App\Http\Controllers\InstallerController::class,"profilestore"],'installer.profile.store');
    });

});
try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Sorry the page you are looking for is  not found");
}
