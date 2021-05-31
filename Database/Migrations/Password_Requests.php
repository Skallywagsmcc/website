<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Password_Requests
{

    public static function up()
    {
        Capsule::schema()->create("password_requests", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("hex");
            $table->string("exchange_key")->nullable();
            $table->datetime("expires");
            $table->timestamps();

        });
    }


}