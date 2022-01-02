<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Addresses
{
    public static function up()
    {
        Capsule::schema()->create("addresses", function ($table) {
            $table->id();
            $table->biginteger("user_id");
            $table->string("entity_name");
            $table->biginteger("entity_id");
            $table->string("title");
            $table->string("slug");
            $table->string("name");
            $table->string("street");
            $table->string("street_2")->nullable();
            $table->string("city");
            $table->string("county");
            $table->string("postcode");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("addresses");
    }


}