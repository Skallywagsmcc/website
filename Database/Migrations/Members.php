<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Members
{

    public static function up()
    {
        Capsule::schema()->create("members",function ($table)
        {
            $table->id();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }



}