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
            $table->foreignId('user_id');
            $table->foreignId('image_id');
            $table->biginteger("status");
            $table->string("expires")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("featured_images");
    }

}