<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class Resources
{


    public static function up()
    {
        Capsule::schema()->create("resources", function ($table) {
            $table->id();
            $table->string("type");
            $table->string("name");
            $table->string("value");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("resources");
    }


}