<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

class System_Rules
{

    public static  function up()
    {
        Capsule::schema()->create("system_rules", function ($table)
        {
            $table->id();
            $table->biginteger("settings_id");
            $table->biginteger("entity_id")->nullable();
            $table->string("entity_name")->nullable();
            $table->string("rule_name");
            $table->integer("status")->default(0);
            $table->text("notes");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("site_settings");
    }

}