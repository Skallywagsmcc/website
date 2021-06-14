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
            $table->string("image_name");
            $table->string("image_size");
            $table->string("image_type");
            $table->string("title");
            $table->text("description");
            $table->BigInteger("featured");
            $table->date("expires");
            $table->timestamps();
        });
    }


}