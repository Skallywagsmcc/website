<?php

namespace App\Http\Libraries\SqlInstaller;

use App\Http\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class Base
{

    public function index()
    {

//        Create Model Called User
        Capsule::schema()->create("users", function ($table) {
            $table->id();
            $table->string("username");
            $table->string("email");
            $table->string("password");
            $table->timestamps();
        });

//        Twofactor auth

        Capsule::schema()->create("two_factor_auths", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("hex");
            $table->string("code");
            $table->string("expire"); //expires in time() + 900 = 15 mins
            $table->timestamps();
        });

//        Csrf

        Capsule::schema()->create("tokens", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("key");
            $table->timestamps();
        });

//        Categories

        Capsule::schema()->create("categories",function($table)
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("title");
            $table->string("slug");
            $table->timestamps();
        });

//        Articles

        Capsule::schema()->create("articles", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->timestamps();
        });

//Profiles

                Capsule::schema()->create("profiles", function ($table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
                    $table->string("first_name", 50);
                    $table->string("Middle_names", 50);
                    $table->string("last_name", 50);
                    $table->longtext("about")->nullable();
                    $table->date("dob")->nullable();
                    $table->string("profile_pic")->nullable();
                    $table->timestamps();
                });


//    Create a Model Called TwoFactorAuth
        Capsule::schema()->create("roles", function ($table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->timestamps();

            $user = new User();
            $user->username = "Administrator";
            $user->email = "Admin@localhost.com";
            $user->password = password_hash("Admin",PASSWORD_DEFAULT);
            $user->save();
        });

        Capsule::schema()->create("user_settings", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->integer("two_factor_auth");
            $table->integer("email_marketing");
            $table->timestamps();
        });


    }


}