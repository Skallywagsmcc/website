<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Likes
{

    public static function up()
    {
        Capsule::schema()->create("likes", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('uuid');
            $table->timestamps();
        });
    }


}