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


try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
