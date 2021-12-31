<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Tokens
{

    public static function up()
    {
        Capsule::schema()->create("tokens", function ($table) {
            $table->id();
            $table->foreignId('user_id');
            $table->biginteger("entity_id")->nullable();
            $table->string("entity_name");
            $table->string("token_hex")->nullable();
            $table->string("token_key")->nullable();
            $table->datetime("expires");
            $table->timestamps();
        });
    }


    public function down()
    {
        Capsule::schema()->dropIfExists("tokens");
    }




}