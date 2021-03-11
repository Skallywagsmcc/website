<?php
require_once ROOT . '/vendor/autoload.php';

use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use Illuminate\Database\Capsule\Manager as Capsule;

//Load env files first
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


require_once "config.php";
require_once "Database.php";

if (Capsule::schema()->hasTable("users")) {
    function Csrf()
    {
        return preg_replace("/@csrf/i", Csrf::Key(), "@csrf");
    }

//Add dotenv support
    $validate = new Validate();
//$validate->Post("csrf");
    $csrf = new Csrf();
}

require_once ROOT . "/Routing/web.php";
