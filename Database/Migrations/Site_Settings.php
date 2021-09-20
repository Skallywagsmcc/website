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
            $table->longtext("contact_address");
            $table->biginteger("contact_telephone");
            $table->text("contact_email");
//            Status 0 for down 1 for up
            $table->biginteger("maintainence_status")->default(1);
            $table->timestamps();
        });
    }
}