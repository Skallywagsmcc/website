<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Site_Settings
{

    public static  function up()
    {
        Capsule::schema()->create("site_settings", function ($table)
        {
            $table->id();
            $table->biginteger("allow_comments")->default(1);
            $table->biginteger("login")->default(1);
            $table->string("email");
//          Block Registration option
            $table->biginteger("registration")->nullable()->default(0);
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("discord")->nullable();
            $table->timestamps();

        });
    }


}