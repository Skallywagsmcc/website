<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Images
{

    public static function up()
    {
        Capsule::schema()->create("images", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("entry_name");
            $table->foreignId('entry_id');
            $table->foreignId('uuid');
            $table->string("title");
            $table->text("description");
            $table->string("name");
            $table->string("size");
            $table->string("type");
            $table->BigInteger("featured");
            $table->timestamps();
        });
    }


}