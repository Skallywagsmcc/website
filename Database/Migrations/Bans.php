<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Articles
{
    public static function up()
    {
        Capsule::schema()->create("articles", function ($table) {
            $table->id();
            $table->string("entry_name");
            $table->integer("user_id");
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("articles");
    }


}