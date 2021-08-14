<?php

namespace App\Libraries\MigrationManager;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Schema;
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

    public function AddTable($name,$requires)
    {
        if(!is_null($requires))
        {
            if(Capsule::schema()->hasTable($requires))
            {
                echo "Table Installed already";
            }
            else
            {
                $this->callup($requires);
            }
        }
        else
        {
            if(Capsule::schema()->hasTable($name))
            {
                echo "Table Installed already";
            }
            else
            {
                $this->callup($name);
            }
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

}