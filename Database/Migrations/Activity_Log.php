<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Activity_Log
{
    public static function up()
    {
        Capsule::schema()->create("activity_log", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->biginteger("by_id");
            $table->biginteger("entity_id");
            $table->string("entity_name");
            $table->string("role");  //create,edit,post,
            $table->timestamps();
        });
    }


    public function down()
    {
        Capsule::schema()->dropIfExists("timeline");
    }
}