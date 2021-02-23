<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

//Instantiate

$router = Router::create();
$router->get("/", [UserController::class, "index"]);
$router->get("/", [UserController::class, "index"]);
$router->get("/api/users", [UserController::class, "userapi"]);
$router->post("/api/users/save", [UserController::class, "userapisave"]);

$router->group(["prefix" => "/auth"], function (Router $router) {
    $router->get("/login", [LoginController::class, "index"]);
    $router->get("/register", [RegisterController::class, "index"]);
    $router->post("/login", [LoginController::class, "store"]);
    $router->post("/register", [RegisterController::class, "store"]);
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
