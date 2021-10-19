<?php

namespace App\Libraries\MigrationManager;

use App\Http\Functions\Validate;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Migrations\Resources;
use Migrations;
use PHPMailer\PHPMailer\PHPMailer;

class Loader extends Core
{


    public function GetDefaults($name)
    {
        $table = strtolower($name);
        if(Capsule::schema()->hasTable($table))
        {
            echo "table $table is already installed";
        }
        else
        {
            $this->callup($name);
        }
    }



    public function install()
    {
        $variables = scandir($this->dir);
        $files = array_diff($variables, array('.', '..'));
        foreach ($files as $index => $file) {
            $name = $this->RemoveExtention($file,".");
            $table = strtolower($name);
            if(Capsule::schema()->hasTable($table))
            {
                echo "$index : table $name is already installed <hr>";
            }
            else
            {
                $this->callup($name);
            }
        }
    }

    public function drop()
    {
        $variables = scandir($this->dir);
        $files = array_diff($variables, array('.', '..'));
        foreach ($files as $index => $file) {
            $name = $this->RemoveExtention($file,".");
            $table = strtolower($name);

                    if(method_exists("Migrations\\$name", "down")) {
                        $this->calldown($name);
                    }
                    else
                    {
                        echo "the class . $name Does not have a method called down <br>";
                    }


        }
    }

}