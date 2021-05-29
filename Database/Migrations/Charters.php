<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Charters
{

    public static function up()
    {
        Capsule::schema()->create("charters",function($table)
        {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->foreignId('uuid');
            $table->text("content");
//            pinned will be used to change the default page
            $table->integer("pinned");
            $table->timestamps();
        });
    }


}