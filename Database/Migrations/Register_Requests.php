<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Register_Requests
{
    public static function up()
    {
        Capsule::schema()->create("register_requests", function ($table) {
            $table->id();
            $table->string("token");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("register_requests");
    }


}