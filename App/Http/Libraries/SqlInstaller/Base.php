<?php

namespace App\Http\Libraries\SqlInstaller;


use Illuminate\Database\Capsule\Manager as Capsule;
use App\Libraries\MigrationManager\Loader;
use Migrations\Users;

class Base
{

    public function index()
    {
        $loader = new Loader();
        $loader->install();
    }


    public function update()
    {

        $loader = new Loader();
        $loader->install();
    }
}