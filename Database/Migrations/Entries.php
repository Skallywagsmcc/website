<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Entries
{

    public static function up()
    {
        Capsule::schema()->create("entries", function ($table) {
            $table->id();
            $table->string("uuid");
            $table->string("entry_name");
            $table->string("slug");
            $table->timestamps();
        });
    }


}