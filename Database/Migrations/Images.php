<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Images
{

    public static function up()
    {
        Capsule::schema()->create("images", function ($table) {
            $table->id();
            $table->string("entry_name");
            $table->foreignId('user_id');
            $table->integer("nvtug");//Not visable to user gallery
            $table->string("title");
            $table->text("description");
            $table->string("name");
            $table->string("size");
            $table->string("type");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("images");
    }



}