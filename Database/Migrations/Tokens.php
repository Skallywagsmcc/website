<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Tokens
{

    public static function up()
    {
        Capsule::schema()->create("tokens", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("key");
            $table->datetime("expires");
            $table->timestamps();

        });
    }

    public static function down()
    {

    }



}