<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Installers

{
    public static function up()
    {
        Capsule::schema()->create("installers", function ($table) {
            $table->id();
            $table->integer("status"); //0 for no 1 for installed 2 for reinstall
            $table->integer("user_id"); //this will be user for installed by
            $table->integer("agreed_terms");
            $table->string("key");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("installers");
    }



}