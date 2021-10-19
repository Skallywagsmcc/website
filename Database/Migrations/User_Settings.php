<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class User_Settings
{

    public static function up()
    {
        Capsule::schema()->create("user_settings", function ($table) {
            $table->id();
            $table->biginteger("user_id");
//            if set to 1  twofactor Auth will be enable if set to 1.
            $table->integer("two_factor_auth");
//            this will stop the website emailing the use if they choose to set this to 0.
            $table->integer("display_email");
//            this will not display if it is set to 0
            $table->integer("display_dob");
//       this will show the username instead if the display is set to 0;
            $table->integer("display_full_name");
            $table->timestamps();

        });
    }


    public function down()
    {
        Capsule::schema()->dropIfExists("user_settings");
    }

}