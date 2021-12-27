<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

class Site_Settings
{

    public static  function up()
    {
        Capsule::schema()->create("site_settings", function ($table)
        {
            $table->id();
            $table->string("admin_email");
            $table->string("entity_name");
            $table->integer("current");
            $table->string("site_version");
            $table->string("site_token") //Will be  hashed code for verification
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("site_settings");
    }

}