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
            $table->string("token"); //remember me token
            $table->integer("is_admin")->default(0);
            $table->integer("login_attempts")->default(0);
            $table->integer("status")->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("users");
    }

}