<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Packages\SqlInstaller\Base;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

//Instantiate

$router = Router::create();
// Index controller
$router->get("/",function(){
    echo "Welcome to the site";
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    $router->getPublisher()->publish("Page not found");
}
