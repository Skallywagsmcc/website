<?php


namespace Migrations;


use App\Http\Models\Profile;
use App\Http\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class Users
{

    public static function up()
    {
        Capsule::schema()->create("users", function ($table) {
            $table->id();
            $table->string("username");
            $table->string("email");
            $table->string("password");
            $table->integer("is_admin")->default(0);
            $table->integer("disable")->default(0);
            $table->integer("deactivate")->default(0);
            $table->timestamps();
        });
    }

    public static function down()
    {

    }

}