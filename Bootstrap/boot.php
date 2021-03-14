<?php
require_once ROOT.'/vendor/autoload.php';
//Load env files first these are important*/
use Illuminate\Database\Capsule\Manager as Capsule;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

require_once "config.php";
require_once "Database.php";
require_once "functions.php";


if(Capsule::schema()->hasTable("users"))
{
    function Csrf()
    {
        return  preg_replace("/@csrf/i",\App\Http\Libraries\Authentication\Csrf::Key(),"@csrf");
    }

//Add dotenv support

    $validate = new \App\Http\Functions\Validate();
//$validate->Post("csrf");
    $csrf = new \App\Http\Libraries\Authentication\Csrf();
}

require_once ROOT ."/Routing/web.php";
