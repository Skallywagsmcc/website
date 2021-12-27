<?php
//ini_set('error_reporting', E_ALL);
use App\Http\Libraries\Authentication\Csrf;
session_start();
ob_start();
$root =  filter_input(5,"DOCUMENT_ROOT");
include_once $root."/Bootstrap/boot.php";
$csrf = new
ob_end_flush();
?>

