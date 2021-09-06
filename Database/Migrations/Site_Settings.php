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
            $table->longtext("address");
//            $table->integer("telephone",11);
            $table->text("email");
            $table->biginteger("allow_comments")->default(0);
            $table->biginteger("login")->default(1);
//          Block Registration option
            $table->biginteger("registration")->nullable()->default(0);
            $table->timestamps();

        });
    }


}