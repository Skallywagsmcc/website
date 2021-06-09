<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Comments
{

    public static function up()
    {
        Capsule::schema()->create("comments", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("entry_name");
            $table->foreignId('entry_id');
            $table->foreignId('uuid');
            $table->string("comment");
            $table->timestamps();

        });
    }


}