<?php
session_start();
ob_start();
define ("ROOT",__DIR__.'/../');
echo "Im in the public folder";
include_once ROOT ."Bootstrap/boot.php";

ob_end_flush();
?>