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
            $table->string("entry_name");
            $table->foreignId('entry_id');
            $table->timestamps();
        });
    }


}