<?php

use App\Http\Controllers\UserController;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;
use App\Http\Libraries\SqlInstaller;

//Instantiate

$router = Router::create();
// Index controller
$router->get("/",[UserController::class,'index']);
$router->get("/install",[SqlInstaller\Base::class,'index']);

$router->group(["prefix"=>"/auth"],function(Router $router)
{
    $router->get("/register",[App\Http\Controllers\RegisterController::class,'index']);
    $router->post("/register",[App\Http\Controllers\RegisterController::class,'store']);
    $router->post("/register/validate",[App\Http\Controllers\PasswordController::class,'store']);

    $router->get("/login",[\App\Http\Controllers\LoginController::class,'index']);
    $router->post("/login",[\App\Http\Controllers\LoginController::class,'store']);

    $router->get("/tfa",[App\Http\Controllers\Auth\TwoFactorAuth::class,'index']);
    $router->post("/tfa/approve",[App\Http\Controllers\Auth\TwoFactorAuth::class,'store']);
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
