<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class Resource_Categories
{


    public static function up()
    {
        Capsule::schema()->create("resource_categories", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->string("name");
            $table->string("slug");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("resources_categories");
    }


}