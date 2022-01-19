<?php
namespace Migrations;
use Illuminate\Database\Capsule\Manager as Capsule;

class Images
{
    public static function up()
    {
        Capsule::schema()->create("images", function ($table) {
            $table->id();
            $table->biginteger('user_id')->nullable();
            $table->string("entity_name");
            $table->biginteger("entity_id");
            $table->string("imagetype");
            $table->string("name");
            $table->string("size");
            $table->string("type");
            $table->timestamps();
        });

//        Will add a  new ImageDescription table in a new version of site
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("images");
    }
}