<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Articles
{

    public static function up()
    {
        Capsule::schema()->create("articles", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('eid');
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->timestamps();
        });
    }


}