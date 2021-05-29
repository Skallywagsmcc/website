<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


echo $_SERVER['DB_DRIVER'];
exit();
$capsule = new Capsule;

    $capsule->addConnection([
        "driver" => $_SERVER['DB_DRIVER'],
        'host' => $_SERVER['DB_HOST'],
        'database' => $_SERVER['DB_NAME'],
        'username' => $_SERVER['DB_USER'],
        'password' => $_SERVER['DB_PASSWORD'],
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => $_SERVER['DB_PREFIX'],
    ]);

// Set the event dispatcher used by Eloquent models... (optional)

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();