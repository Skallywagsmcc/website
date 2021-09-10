<?php


use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;


//Instantiate

$router = Router::create();
// Index controller

$router->group(["prefix"=>"/api"],function(Router $router)
{
    $router->get("/",function()
    {
       echo "Hello";
    });
});

try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // If compiler is here, it means user  wants a page that does not exist
    // Show your 404 page or use something like this:
    echo "failed";
}
