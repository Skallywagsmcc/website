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




    public function ReadMigrations()
    {
           return $this->scandir($this->dir);
    }


    public function install()
    {
        $files = $this->scandir($this->dir);
        foreach ($files as $index => $file) {
            $name = $this->RemoveExtention($file, ".");
            $table = $this->lower($name);
            if ($this->hastable($table) == false) {
                $this->callup($name);
            }
        }
    }


    public function drop($migrations=null)
    {
        $files = $this->scandir($this->dir);
        foreach ($files as $index => $file) {
            $name = $this->RemoveExtention($file, ".");
            $table = strtolower($name);
            $this->calldown($name);
        }
    }

}