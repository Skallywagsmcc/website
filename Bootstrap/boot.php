<?php
require_once ROOT.'/vendor/autoload.php';
//Load env files first
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


require_once "config.php";
require_once "Database.php";

function Csrf()
{
    return  preg_replace("/@csrf/i",\App\Http\Libraries\Authentication\Csrf::Key(),"@csrf");
}

//Add dotenv support

$validate = new \App\Http\Functions\Validate();
//$validate->Post("csrf");
$csrf = new \App\Http\Libraries\Authentication\Csrf();
$csrf->Token();

require_once ROOT ."/Routing/web.php";
