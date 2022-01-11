<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Ban_History
{
    public static function up()
    {
        Capsule::schema()->create("ban_history", function ($table) {
            $table->id();
            $table->biginteger("ban_id");
            $table->biginteger("user_id");
            $table->biginteger("banned_by_id");
            $table->longtext("reason");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("ban_history");
    }


}