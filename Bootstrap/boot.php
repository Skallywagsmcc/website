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



//  $csrf = new \App\Http\Libraries\Authentication\Csrf();

 
require_once ROOT ."/Routing/web.php";

