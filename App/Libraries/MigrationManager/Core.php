<?php

namespace App\Libraries\MigrationManager;


class Core
{
    protected $dir;
    private $class = "Migrations";

    public function __construct()
    {
        $this->dir = __DIR__ . "/../../../Database/Migrations";
    }

    public  static function RemoveExtention($file, $delimiter)
    {
        $explode = explode($delimiter, $file);
        array_pop($explode);
        return implode($delimiter, $explode);
    }


    public function scandir($dir){

        $variables = scandir($dir);
        $files = array_diff($variables, array('.', '..'));
        return $files;
    }


    public function callup($name)
    {
        return call_user_func($this->class ."\\$name::up");
    }

    public function calldown($name)
    {
        return call_user_func($this->class ."\\$name::down");
    }

}