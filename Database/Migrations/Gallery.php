<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Gallery
{

    public static function up()
    {
        Capsule::schema()->create("galleryies", function ($table) {
            $table->id();
            $table->string("entry_name");
            $table->integer("entry_id");
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }


}