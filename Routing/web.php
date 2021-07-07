<?php

use App\Http\Controllers\Account\AboutController;
use App\Http\Controllers\Account\BasicInfoController;
use App\Http\Controllers\Account\EmailController;
use App\Http\Controllers\Account\PasswordController;
use App\Http\Controllers\Account\ProfilePictureController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\ArticlesController as AdminArticles;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\TwoFactorAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\CommentsController;
use App\Http\Controllers\Profile\GalleryController;
use App\Http\Controllers\Profile\ImageController;
use App\Http\Controllers\SearchController;
use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\SqlInstaller\Base;
use App\Http\Middleware;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;


//Instantiate

$router = Router::create();
// Index controller

$router->get("/", [HomeController::class, 'index'], "homepage");
$router->get("/contact-us", [ContactController::class, 'index'], "contact-us");
$router->post("/contact-us/send", [ContactController::class, 'store'], "contact-store");
$router->get("/contact-us/thank-you", [ContactController::class, 'sent'], "contact-sent");
$router->get("/sql/install", [Base::class, 'index']);
$router->get("/sql/update", [Base::class, 'update']);

$router->group(["prefix" => "/search"], function (Router $router) {
    $router->get("/?", [SearchController::class, 'index'], "search.home");
    $router->get("/view", [SearchController::class, 'view'], "search.view");
});

$router->group(["prefix" => "/members"], function (Router $router) {
    $router->get("/?", [\App\Http\Controllers\Members::class, "index"], "members.home");
});

$router->group(["prefix" => "/secure/tfa", "middleware" => [Middleware\RequireLogin::class]], function (Router $router) {
    $router->get("/?", [TwoFactorAuthController::class, "index"], "tfa.index");
    $router->post("/request", [TwoFactorAuthController::class, "create"], "tfa.get");
    $router->get("/request/user/{id}/token/{hex}", [TwoFactorAuthController::class, "show"], "tfa.retrieve");
    $router->post("/save", [TwoFactorAuthController::class, "store"], "tfa.save");
});


$router->group(["prefix" => "/charters"], function (Router $router) {
    $router->get("/?", [\App\Http\Controllers\ChartersController::class, 'index'], "charters.home");
    $router->get("/view/{slug}", [\App\Http\Controllers\ChartersController::class, 'show'], "charters.view");
});

$router->group(["prefix"=>"/terms"],function (Router $router)
{
    $router->get("/?",function(){
        echo "terms";
    },"terms.home");
});


$router->group(["prefix" => "/events"], function (Router $router) {
    $router->get("/?", [\App\Http\Controllers\EventsController::class, 'index'], "events.home");
    $router->get("/view/{slug}", [\App\Http\Controllers\EventsController::class, 'show'], "events.view");
});


$router->group(["prefix" => "/auth"], function (Router $router) {
    $router->get("/login", [LoginController::class, 'index'], "login");
    $router->post("/login/success", [LoginController::class, 'store'], "login.store");
    $router->get("/logout", [LoginController::class, 'logout'], "logout");
    $router->get("/reset-password", [\App\Http\Controllers\PasswordController::class, "index"], "password-reset.index");
    $router->post("/reset-password/request", [\App\Http\Controllers\PasswordController::class, "request"], "password-reset.request");
    $router->get("/reset-password/retrieve/{id}/{hex}", [\App\Http\Controllers\PasswordController::class, "retrieve"], "password-reset.retrieve");
    $router->post("/reset-password/store", [\App\Http\Controllers\PasswordController::class, "store"], "password-reset.store");
    $router->post("/reset-password/cancel", [\App\Http\Controllers\PasswordController::class, "cancelrequest"], "password.cancel.index");
    $router->post("/reset-password/cancel/store", [\App\Http\Controllers\PasswordController::class, "cancelStore"], "password.cancel.store");
});

$router->group(["prefix" => "/articles"], function (Router $router) {
    $router->get("/?", [ArticlesController::class, 'index'], "articles.home");
    $router->any("/by-year/{year}", [ArticlesController::class, 'year'], "articles.year");
    $router->get("/{slug}", [ArticlesController::class, 'view'], "articles.view");
});

$router->group(["prefix" => "/manage/likes"], function (Router $router) {
    $router->get("/add/{uuid}", [\App\Http\Controllers\LikesController::class, 'create'], 'likes.create');
    $router->get("/delete/{uuid}", [\App\Http\Controllers\LikesController::class, 'destroy'], 'likes.delete');
});

$router->group(["prefix" => "/admin", "middleware" => [Middleware\AdminAuthMiddleware::class, Middleware\AdminTfa::class]], function (Router $router) {

    $router->group(["prefix" => "/events"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\Admin\EventsController::class, "index"], "admin.events.home");
        $router->get("/create", [\App\Http\Controllers\Admin\EventsController::class, "create"], "admin.events.new");
        $router->post("/store", [\App\Http\Controllers\Admin\EventsController::class, "store"], "admin.events.store");
        $router->get("/edit/{id}", [\App\Http\Controllers\Admin\EventsController::class, "edit"], "admin.events.edit");
        $router->post("/update", [\App\Http\Controllers\Admin\EventsController::class, "update"], "admin.events.update");
    });


    $router->group(["prefix" => "/charters"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\Admin\ChartersController::class, 'index'], "admin.charters.home");
        $router->get("/view/{id}", [\App\Http\Controllers\Admin\ChartersController::class, 'view'], "admin.charters.view");
        $router->get("/new", [\App\Http\Controllers\Admin\ChartersController::class, 'create'], "admin.charters.create");
        $router->post("/create/save", [\App\Http\Controllers\Admin\ChartersController::class, 'store'], "admin.charters.store");
        $router->get("/edit/{id}", [\App\Http\Controllers\Admin\ChartersController::class, 'edit'], "admin.charters.edit");
        $router->post("/update/save", [\App\Http\Controllers\Admin\ChartersController::class, 'update'], "admin.charters.update");
        $router->get("/delete/{id}", [\App\Http\Controllers\Admin\ChartersController::class, 'delete'], "admin.charters.delete");
    });

//Users
    $router->group(["prefix" => "/users"], function (Router $router) {
        $router->get("/?", [UsersController::class, 'index'], "admin.users.home");
        $router->get("/new", [UsersController::class, 'create'], "admin.users.create");
        $router->post("/new", [UsersController::class, 'store'], "admin.users.store");
        $router->get("/edit/{id}/{username}", [UsersController::class, 'edit'], "admin.users.edit");
        $router->post("/edit/save", [UsersController::class, 'update'], "admin.users.update");
        $router->get("/delete/{id}", [UsersController::class, 'delete'], "admin.users.delete");
    });

    $router->group(["prefix" => "/articles"], function (Router $router) {
        $router->get("/?", [AdminArticles::class, 'index'], "admin.articles.home");
        $router->get("/new", [AdminArticles::class, 'create'], "admin.articles.new");
        $router->post("/new", [AdminArticles::class, 'store'], "admin.articles.store");
        $router->get("/edit/{slug}/{id}", [AdminArticles::class, 'edit'], "admin.articles.edit");
        $router->post("/edit", [AdminArticles::class, 'update'], "admin.articles.update");
        $router->get("/delete/{id}", [AdminArticles::class, 'delete'], "admin.articles.delete");
        $router->post("/delete/image", [AdminArticles::class, 'deleteimages'], "admin.articles.images.delete");
    });

    $router->group(["prefix" => "/images"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\Admin\ImageController::class, "index"], "admin.images.home");
        $router->get("/search", [\App\Http\Controllers\Admin\ImageController::class, "search"], "admin.images.search");
        $router->get("/view/{username}/{id}", [\App\Http\Controllers\Admin\ImageController::class, "view"], "admin.images.manage");
        $router->get("/search", [\App\Http\Controllers\Admin\ImageController::class, "search"], "admin.images.search");
        $router->get("/view/{id}", [\App\Http\Controllers\Admin\ImageController::class, "delete"], "admin.images.delete");
        $router->get("/featured", [FeaturedController::class, "index"], "admin.images.featured.index");
        $router->get("/featured/edit/{id}", [FeaturedController::class, "edit"], "admin.images.featured.manage");
        $router->post("/featured/store", [FeaturedController::class, "store"], "admin.images.featured.store");
    });

    $router->get("/settings", [\App\Http\Controllers\Admin\SettingsController::class, "index"], "admin.settings");
    $router->post("/settings/save", [\App\Http\Controllers\Admin\SettingsController::class, "store"], "admin.settings.store");
    $router->get("/?", [\App\Http\Controllers\Admin\HomeController::class, "index"], "admin.home");

});

$router->group(["prefix"=>"/profile"],function (Router $router) {
    $router->group(["prefix" => "/{username}"], function (Router $router) {
        $router->get("/?", [\App\Http\Controllers\Profile\HomeController::class, 'show'], "profile.view");
        $router->group(["prefix" => "/gallery"], function (Router $router) {
            $router->get("/?", [\App\Http\Controllers\Profile\GalleryController::class, 'index'], "profile.gallery.home");
            $router->get("/image/{id}", [\App\Http\Controllers\Profile\GalleryController::class, 'show'], "profile.gallery.view");
        });
    });
    $router->get("/?", [\App\Http\Controllers\Profile\HomeController::class, 'index'], "profile.home");
});





$router->group(["prefix"=>"/access/user-cp","middleware" => [Middleware\RequireLogin::class, Middleware\TwoFactorAuth::class]],function(Router $router){

    $router->group(["prefix" => "/account"] , function (Router $router) {
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
//    Load Base Page
    $router->get("/?",[\App\Http\Controllers\Backend\Homecontroller::class,"index"],"backend.home");
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish(TemplateEngine::View("Templates.PageNotFound"));
}
