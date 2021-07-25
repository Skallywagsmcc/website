<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Events_Timeline
{

    public static function up()
    {
        Capsule::schema()->create("events_timeline",function($table)
        {
            $table->id();
            $table->foreignId('event_id');
            $table->string("location");
            $table->time("time");
            $table->timestamps();
        });
    }


}