<?php

$router->group(["prefix" => "/admin"], function (\MiladRahimi\PhpRouter\Router $router) {
    $router->get("/?", [\App\Http\Controllers\Admin\HomeController::class,'index']);
});

$router->group(["prefix" => "/admin/users"], function (\MiladRahimi\PhpRouter\Router $router) {
    $router->get("/?", [\App\Http\Controllers\Admin\UsersController::class,'index']);
    $router->get("/new", [\App\Http\Controllers\Admin\UsersController::class,'create']);
    $router->post("/new", [\App\Http\Controllers\Admin\UsersController::class,'store']);
    $router->get("/edit/{id}/{username}", [\App\Http\Controllers\Admin\UsersController::class,'edit']);
    $router->post("/edit", [\App\Http\Controllers\Admin\UsersController::class,'update']);
    $router->get("/delete/{id}", [\App\Http\Controllers\Admin\UsersController::class,'delete']);
    $router->post("/search", [\App\Http\Controllers\Admin\UsersController::class,'search']);
});


$router->group(["prefix" => "/admin/blog"], function (\MiladRahimi\PhpRouter\Router $router) {
    $router->get("/?", [\App\Http\Controllers\Admin\Blogscontroller::class,'index']);
    $router->get("/new", [\App\Http\Controllers\Admin\Blogscontroller::class,'create']);
    $router->post("/new", [\App\Http\Controllers\Admin\Blogscontroller::class,'store']);
    $router->get("/edit/{id}", [\App\Http\Controllers\Admin\Blogscontroller::class,'edit']);
    $router->get("/edit/delete/{id}", [\App\Http\Controllers\Admin\Blogscontroller::class,'delete']);
});


$router->group(["prefix" => "/admin/roles"], function (\MiladRahimi\PhpRouter\Router $router) {
    $router->get("/?", [\App\Http\Controllers\Admin\RolesController::class,'index']);
    $router->get("/new", [\App\Http\Controllers\Admin\RolesController::class,'create']);
    $router->post("/new", [\App\Http\Controllers\Admin\RolesController::class,'store']);
    $router->get("/edit/{id}", [\App\Http\Controllers\Admin\RolesController::class,'edit']);
    $router->post("/edit", [\App\Http\Controllers\Admin\RolesController::class,'update']);
    $router->get("/delete/{id}", [\App\Http\Controllers\Admin\RolesController::class,'delete']);
});


$router->group(["prefix" => "/admin/settings"], function (\MiladRahimi\PhpRouter\Router $router) {
    $router->get("/?", [\App\Http\Controllers\Admin\HomeController::class,'index']);
    $router->get("/new", [\App\Http\Controllers\Admin\HomeController::class,'create']);
});