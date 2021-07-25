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
            $table->string("exchange_key")->nullable();
            $table->integer("disable")->default(0);
            $table->integer("deactivate")->default(0);
            $table->timestamps();


        });

        $user = new User();
        $user->id = 1;
        $user->username = "theladsdad";
        $user->email = "mbamber1986@gmail.com";
        $user->password = password_hash("Bennyboo2k11",PASSWORD_DEFAULT);
        $user->is_admin = 1;
        $user->save();
    }

    public static function down()
    {

    }

}