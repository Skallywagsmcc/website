<?php
require_once ROOT.'/vendor/autoload.php';
//Load env files first
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


require_once "config.php";
require_once "Database.php";

//Add dotenv support

//Must be the last thing to load on
require_once ROOT ."/Routing/web.php";
