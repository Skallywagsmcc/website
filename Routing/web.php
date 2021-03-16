<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Profile\DisplayController;
use App\Http\Controllers\UserController;
use App\Http\Libraries\SqlInstaller;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

//Instantiate

$router = Router::create();
// Index controller
$router->get("/", [UserController::class, 'index']);
$router->get("/install",[SqlInstaller\Base::class,'index']);

$router->get("/auth/login",[LoginController::class,'index']);
$router->post("/auth/login",[LoginController::class,'store']);

$router->get("/articles", [\App\Http\Controllers\ArticlesController::class, 'index']);
$router->get("/articles/view/{slug}", [\App\Http\Controllers\ArticlesController::class, 'view']);

$router->group(["prefix"=>"/admin"],function(Router $router)
{

    $router->group(["prefix"=>"/categories"],function(Router $router)
    {
        $router->get("/?",[\App\Http\Controllers\Admin\CategoriesController::class,'index']);
    });

    $router->group(["prefix"=>"/blog"],function(Router $router)
    {
        $router->get("/?",[\App\Http\Controllers\Admin\ArticlesController::class,'index']);
        $router->get("/new",[\App\Http\Controllers\Admin\ArticlesController::class,'create']);
        $router->post("/new",[\App\Http\Controllers\Admin\ArticlesController::class,'store']);
        $router->get("/edit/{slug}/{id}",[\App\Http\Controllers\Admin\ArticlesController::class,'edit']);
        $router->post("/edit",[\App\Http\Controllers\Admin\ArticlesController::class,'update']);
    });
});





try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
