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
            $table->biginterger("telephone");
            $table->text("email");
//          Block Registration option
            $table->timestamps();
        });
    }
}