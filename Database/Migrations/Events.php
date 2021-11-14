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
            $table->string("entry_name");
            $table->biginteger('user_id');
            $table->biginteger("thumbnail")->nullable();
            $table->biginteger("cover")->nullable();
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
//            EEL Event End Location ESL Event Start Location Start at and end at are the date and time of event
            $table->datetime("start_at");
            $table->datetime("end_at");
            $table->biginteger("meet_id");
            $table->biginteger("dest_id");
            $table->string("map_url")->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("events");
    }




}