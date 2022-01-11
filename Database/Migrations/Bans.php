<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Bans
{
    public static function up()
    {
        Capsule::schema()->create("bans", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->datetime("expires");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("bans");
    }


}