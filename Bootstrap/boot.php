<?php
require_once filter_input(5,"DOCUMENT_ROOT").'/vendor/autoload.php';
use App\Http\Libraries\Authentication\Csrf;
//Load env files first these are important*/
use Illuminate\Database\Capsule\Manager as Capsule;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

require "config.php";
require "functions.php";
require_once "Database.php";

ClearBladeCache();
if(Capsule::schema()->hasTable("users")){
$csrf = new \App\Http\Libraries\Authentication\Csrf();
echo $csrf->ValidExpire();
}

require_once ROOT ."/Routing/web.php";

