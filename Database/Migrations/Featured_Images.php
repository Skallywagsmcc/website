<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Featured_Images
{

    public static function up()
    {
        Capsule::schema()->create("featured_images",function($table)
        {
            $table->id();
            $table->foreignId('image_id')->nullable();
            $table->biginteger("status");
            $table->string("expires")->nullable();
            $table->timestamps();
        });
    }


}