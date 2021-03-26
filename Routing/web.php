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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Profile\AccountController;
use App\Http\Controllers\Profile\CommentsController;
use App\Http\Controllers\Profile\DisplayController;
use App\Http\Controllers\Profile\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Libraries\SqlInstaller;
use App\Http\Middleware;
use Laminas\Diactoros\Response\JsonResponse;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;


//Instantiate

$router = Router::create();
// Index controller
$router->get("/", [UserController::class, 'index']);
$router->get("/sql/install", [SqlInstaller\Base::class, 'index']);

$router->get("/auth/login", [LoginController::class, 'index'], "index.home");
$router->post("/auth/login", [LoginController::class, 'store']);
$router->get("/auth/logout", [LoginController::class, 'logout']);

$router->group(["prefix", "articles"], function (Router $router) {
    $router->get("/articles", [PageController::class, 'index']);
    $router->get("/articles/view/{slug}", [PageController::class, 'view']);
});

$router->group(["prefix" => "/admin"], function (Router $router) {

    $router->group(["prefix" => "/users"], function (Router $router) {
        $router->get("/?", [UsersController::class, 'index'], "admin");
        $router->get("/new", [UsersController::class, 'create']);
        $router->post("/new", [UsersController::class, 'store']);
        $router->get("/edit/{id}/{username}", [UsersController::class, 'edit']);
        $router->post("/edit/", [UsersController::class, 'update']);
        $router->get("/delete/{id}", [UsersController::class, 'delete']);
    });

    $router->group(["prefix" => "/categories"], function (Router $router) {
        $router->get("/?", [CategoriesController::class, 'index']);
    });

    $router->group(["prefix" => "/blog"], function (Router $router) {
        $router->get("/?", [PagesController::class, 'index']);
        $router->get("/new", [PagesController::class, 'create']);
        $router->post("/new", [PagesController::class, 'store']);
        $router->get("/edit/{slug}/{id}", [PagesController::class, 'edit']);
        $router->post("/edit", [PagesController::class, 'update']);
    });


});


$router->group(["prefix" => "/profile/{username}"], function (Router $router) {

    $router->group(["prefix" => "/gallery"], function (Router $router) {
        $router->get("/?", [DisplayController::class, 'gallery'], "gallery");
        $router->get("/image/{id}", [DisplayController::class, 'DisplayImage']);
        $router->post("/comments/add", [CommentsController::class, 'store']);
        $router->post("/upload", [ImageController::class, 'store']);
        $router->get("/comment/delete/{id}", [CommentsController::class, 'delete']);
        $router->get("/image/delete/{id}", [ImageController::class, 'delete']);
    });

    $router->get("/?", [DisplayController::class, 'index']);
});


$router->group(["prefix" => "/account", "middleware" => [Middleware\IsLoggedIn::class]], function (Router $router) {
    $router->get("/?", [AccountController::class, 'index']);
    $router->get("/edit/basic", [BasicInfoController::class, 'index']);
    $router->post("/edit/basic", [BasicInfoController::class, 'store']);
    $router->get("/edit/about", [AboutController::class, 'index']);
    $router->post("/edit/about", [AboutController::class, 'store']);
    $router->get("/edit/picture", [ProfilePictureController::class, 'index']);
    $router->post("/edit/picture", [ProfilePictureController::class, 'store']);
    $router->get("/edit/password", [PasswordController::class, 'index']);
    $router->post("/edit/password", [PasswordController::class, 'store']);
    $router->get("/edit/email", [EmailController::class, 'index']);
    $router->post("/edit/email", [EmailController::class, 'store']);
    $router->get("/edit/settings", [SettingsController::class, 'index']);
    $router->post("/edit/settings", [SettingsController::class, 'store']);
});

$router->get('/links', function (Url $url) {
    return new JsonResponse([
        'index.home' => $url->make('index.home'),
    ]);
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
