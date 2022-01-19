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
            $table->integer("user_id");
            $table->integer("thumbnail")->nullable();
            $table->integer("cover")->nullable();
            $table->string("title");
            $table->string("slug");
            $table->text("content");
//            pinned will be used to change the default page
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("charters");
    }



}