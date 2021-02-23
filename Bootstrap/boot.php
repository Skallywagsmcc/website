<?php
require_once ROOT.'/vendor/autoload.php';
require_once "config.php";
require_once "Database.php";

//Add dotenv support
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
//Must be the last thing to load on
require_once ROOT ."/Routing/web.php";
