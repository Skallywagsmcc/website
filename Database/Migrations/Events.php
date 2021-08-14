<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Events
{

    public static function up()
    {
        Capsule::schema()->create("events",function($table)
        {
            $table->id();
            $table->foreignid("thumbnail");
            $table->string("title");
            $table->foreignId('user_id');
            $table->string("uuid");
            $table->string("slug");
            $table->longtext("content");
            $table->datetime("start")->nullable();
            $table->datetime("end")->nullable();
            $table->longtext("address")->nullable();
            $table->timestamps();

        });
    }


}