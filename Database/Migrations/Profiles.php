<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class Profiles
{

    public static function up()
    {
        Blueprint::macro('fulltext', function ($columns, $name = null, $algorithm = null)
        {
            return $this->indexCommand('fulltext', $columns, $name, $algorithm);
        });

        Capsule::schema()->create("profiles", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->integer("is_crew")->default(0);
            $table->string("profile_pic")->nullable();
            $table->string("cover")->nullable(); //coming soon
            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->longtext("about")->nullable();
            $table->date("dob")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("profiles");
    }



}