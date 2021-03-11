<?php
namespace App\Http\Libraries\SqlInstaller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Http\Models\User;

class Base
{

public function index()
{

//        Create Model Called User
        Capsule::schema()->create("users",function($table)
        {
            $table->id();
            $table->integer("two_factor_auth");
            $table->string("username");
            $table->string("email");
            $table->string("password");
            $table->timestamps();
        });

//        Create  a Model Called Token
        Capsule::schema()->create("tokens",function($table)
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("key");
            $table->timestamps();
        });

        // Create a Model Called TwoFactorAuth
        Capsule::schema()->create("two_factor_auths",function($table)
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("hex");
            $table->string("code");
            $table->string("expire"); //expires in time() + 900 = 15 mins
            $table->timestamps();
        });

//       Create a Model Called Profile

        Capsule::schema()->create("profiles",function($table){
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("first_name",50);
            $table->string("Middle_names",50);
            $table->string("last_name",50);
            $table->longtext("about")->nullable();
            $table->date("dob")->nullable();
            $table->string("profile_pic")->nullable();
            $table->timestamps();
        });

//        Create a Model Called MedicalRecord

        Capsule::schema()->create("medical_records",function($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("about");
            $table->string("nok_name");
            $table->string("nok_number");
            $table->timestamps();
        });

        // Redirect code at the end
        header("location:/install");
    }

    // Create a Model Called TwoFactorAuth
    Capsule::schema()->create("blogs",function($table)
    {
        $table->id();
        $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
        $table->string("title");
        $table->string("slug");
        $table->longtext("content");
        $table->timestamps();
    });



     Create a Model Called TwoFactorAuth
    Capsule::schema()->create("roles",function($table)
    {
        $table->id();
        $table->string("title");
        $table->string("slug");
        $table->timestamps();
    });
    



}