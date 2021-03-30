<?php

namespace App\Http\Libraries\SqlInstaller;

use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Profile;
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
            $table->datetime("expires");
            $table->timestamps();
        });

//        Categories

        Capsule::schema()->create("categories", function ($table) {
            $table->id();
            $table->integer("user_id");
            $table->string("title");
            $table->string("slug");
            $table->integer("pinned")->nullable();
            $table->integer("edited_by"); //user_id goes here to find out who last edited the item
            $table->timestamps();
        });

//        Articles

        Capsule::schema()->create("pages", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->integer("pinned")->nullable();
            $table->integer("edited_by"); //user_id goes here to find out who last edited the item
            $table->timestamps();
        });

//Profiles

        Capsule::schema()->create("profiles", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("first_name", 50);
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

//            create a dummy account
            $user = new User();
            $user->username = "Administrator";
            $user->email = "Admin@localhost.com";
            $user->password = password_hash("Admin", PASSWORD_DEFAULT);
            $user->save();

            $profile = new Profile();
            $profile->user_id = Auth::id();
            $profile->save();
        });

        Capsule::schema()->create("user_settings", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
//            if set to 1  twofactor auth will be enable if set to 1.
            $table->integer("two_factor_auth");
//            this will stop the website emailing the use if they choose to set this to 0.
            $table->integer("email_marketing");
//            this will not display if it is set to 0
            $table->integer("display_dob");
//       this will show the username instead if the display is set to 0;
            $table->integer("display_full_name");
            $table->timestamps();
        });

        Capsule::schema()->create("images", function ($table) {
            $table->id();
//            this will link to the user
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
//            this will link to the article id. this wont delete if the article is deleted.
            $table->foreignId('page_id');
            $table->string("image_name");
            $table->string("image_size");
            $table->string("image_type");
            $table->timestamps();
        });

        Capsule::schema()->create("comments", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId('image_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId('page_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("comment");
            $table->timestamps();
        });

    }

}