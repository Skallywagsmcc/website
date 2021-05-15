<?php
require_once ROOT.'/vendor/autoload.php';
//Load env files first these are important*/
use Illuminate\Database\Capsule\Manager as Capsule;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

require_once "config.php";
require "functions.php";
require_once "Database.php";

ClearBladeCache();

<<<<<<< HEAD
if(Capsule::schema()->hasTable("users")){
$csrf = new \App\Http\Libraries\Authentication\Csrf();
}


=======


//  $csrf = new \App\Http\Libraries\Authentication\Csrf();
>>>>>>> 09cce0aeaf2535a814c2aaaaabce000a5ec4d2fc

 
require_once ROOT ."/Routing/web.php";

