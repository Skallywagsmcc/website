<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Libraries\SqlInstaller;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

//Instantiate

$router = Router::create();
// Index controller
$router->get("/", [UserController::class, 'index']);
$router->post("/", [UserController::class, 'index']);
$router->get("/install", [SqlInstaller\Base::class, 'index']);

include_once "includes/admin_web.php";
$router->group(["prefix" => "/auth"], function (Router $router) {
    $router->get("/register", [App\Http\Controllers\RegisterController::class, 'index']);
    $router->post("/register", [App\Http\Controllers\RegisterController::class, 'store']);
    $router->post("/register/validate", [App\Http\Controllers\PasswordController::class, 'store']);

    $router->get("/login", [LoginController::class, 'index']);
    $router->post("/login", [LoginController::class, 'store']);

    $router->get("/tfa", [App\Http\Controllers\Auth\TwoFactorAuth::class, 'index']);
    $router->post("/tfa/approve", [App\Http\Controllers\Auth\TwoFactorAuth::class, 'store']);


    $router->get("/reset-password", [PasswordController::class, 'index']);
    $router->get("/reset-password/request/{id}/{hex}", [PasswordController::class, 'retrieve']);
    $router->post("/reset-password", [PasswordController::class, 'request']);
    $router->post("/reset-password/update", [PasswordController::class, 'store']);
});

$router->group(["prefix" => "/profile"], function (Router $router) {
    $router->get("/?", [ProfileController::class, "index"]);
    $router->get("/editor/create", [ProfileController::class, "create"]);
    $router->post("/editor/create", [ProfileController::class, "store"]);
    $router->get("/editor/manage", [ProfileController::class, "edit"]);
    $router->post("/editor/manage", [ProfileController::class, "update"]);
}
);
try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
