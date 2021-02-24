<?php

namespace App\Http\Packages\SqlInstaller;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Http\Models\User;

class Base
{

public function index()
{
    if(Capsule::schema()->hastable("users"))
    {
        echo "Table exisits";
    }
    else{
        Capsule::schema()->create("users",function($table)
        {
            $table->id();
            $table->int("tfa");
            $table->string("username");
            $table->string("email");
            $table->string("password");
            $table->timestamps();
        });

        
        Capsule::schema()->create("tokens",function($table)
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("key");
            $table->timestamps();
        });
        
        // this will be used for Password Resets as well.
        Capsule::schema()->create("tfa_requests",function($table)
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("hex");
            $table->string("code");
            $table->string("expire"); //expires in time() + 900 = 15 mins
            $table->timestamps();
        });

        // Redirect code at the end
        header("location:/install");
    }

    

}


}