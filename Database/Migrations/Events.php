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
            $table->foreignid("cover");
            $table->string("title");
            $table->foreignId('user_id');
            $table->string("uid");
            $table->string("slug");
            $table->longtext("content");
//            EEL Event End Location ESL Event Start Location Start at and end at are the date and time of event
            $table->datetime("start_at")->nullable();
            $table->datetime("end_at")->nullable();
            $table->longtext("esl")->nullable();
            $table->longtext("eel")->nullable();
            $table->string("map_url");
            $table->timestamps();

        });
    }


}