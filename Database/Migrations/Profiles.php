<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Profiles
{

    public static function up()
    {
        Capsule::schema()->create("profiles", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->longtext("about")->nullable();
            $table->date("dob")->nullable();
            $table->string("profile_pic")->nullable();
            $table->timestamps();
        });
    }


}