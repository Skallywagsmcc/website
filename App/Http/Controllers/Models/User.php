<?php


namespace App\Http\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as Capsule;

class User extends Controller
{

    public function Token()
    {
        return $this->hasOne(Token::class);
    }

    public function install()
    {
        if(Capsule::schema()->hasTable("users"))
        {
            echo "table exsists";

        }
        else
        {
            Capsule::schema()->create("users", function ($table) {
                $table->id();
                $table->string("username");
                $table->string("email");
                $table->string("password");
                $table->timestamps();
            });
        }
    }

}