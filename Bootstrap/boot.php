<?php
require_once ROOT.'/vendor/autoload.php';
//Load env files first these are important*/
use Illuminate\Database\Capsule\Manager as Capsule;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

require "config.php";
require "functions.php";
require_once "Database.php";
require "Router.php";

//ClearBladeCache();

if(Capsule::schema()->hasTable("users")){
$csrf = new \App\Http\Libraries\Authentication\Csrf();
}

require_once ROOT ."/Routing/web.php";

