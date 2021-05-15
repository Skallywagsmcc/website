<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Two_Factor_Auths
{

    public static function up()
    {
        Capsule::schema()->create("two_factor_auths", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("hex");
            $table->string("code");
            $table->string("expire"); //expires in time() + 900 = 15 mins
            $table->timestamps();
        });
    }


}