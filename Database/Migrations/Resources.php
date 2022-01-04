<?php

namespace Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class Resources
{

    public static function up()
    {
        Capsule::schema()->create("resources", function ($table) {
            $table->id();
            $table->string("type");
            $table->string("entity_name");
            $table->biginteger("entity_id");
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