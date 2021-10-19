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
            $table->longtext("contact_address");
            $table->biginteger("contact_telephone");
            $table->text("contact_email");
//            Status 0 for down 1 for up
            $table->biginteger("maintainence_status")->default(1);
            $table->integer("open_login")->default(1);
            $table->integer("open_registration")->default(1);
            $table->integer("lock_submissions")->default(0); // Add now and implement at a future date
            $table->text("lock_message")->nullable();
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("site_settings");
    }

}