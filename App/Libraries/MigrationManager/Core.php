<?php

namespace App\Libraries\MigrationManager;

use Illuminate\Database\Capsule\Manager as Capsule;
use Migrations;


class Core
{
    public $dir;
    private $class = "Migrations";


    public function __construct()
    {
        $this->dir = ROOT."/Database/Migrations";
    }
    public function filter($array,$value)
    {
            return array_diff($array, (is_array($value) ? $value : array($value)));
    }



    public function getfiles($file)
    {
        return file_get_contents("$this->dir/$file");
    }


    public function lower($value)
    {
        return strtolower($value);
    }


    public function RemoveExtention($file, $delimiter)
    {
        $explode = explode($delimiter, $file);
        array_pop($explode);
        return implode($delimiter, $explode);
    }

    public function hastable($table)
    {
        if (Capsule::schema()->hasTable($table)) {
            return true;
        } else {
            return false;
        }
    }
    public function scandir($dir)
    {
        $variables = scandir($dir);
        $files = array_diff($variables, array('.', '..'));
        return $files;
    }

    public function callup($name)
    {
        return call_user_func($this->getclass() . "\\$name::up");
    }

    public function getclass()
    {
        return $this->class;
    }

    public function calldown($name)
    {
        return call_user_func($this->getclass() . "\\$name::down");

    }

    protected final function hasmethod($name = null)
    {

        if (method_exists("Migrations\\$name", $name)) {
            return true;
        } else {
            return false;
        }
    }

}