<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Terms
{

    public static function up()
    {
        Capsule::schema()->create("terms", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('uuid');
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->timestamps();
        });
    }


}