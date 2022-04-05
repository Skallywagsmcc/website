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
        Capsule::schema()->create("activity_logs", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->string("type"); //blog event image upload,login, login attempt, Password Reset,
            $table->string("action"); // create edit, delete
            $table->string("url")->nullable();
            $table->longtext("reason")->nullable();
            $table->biginteger("aod"); //Admin only display;
            $table->timestamps();
        });
    }


    public function down()
    {
        Capsule::schema()->dropIfExists("activity_logs");
    }
}