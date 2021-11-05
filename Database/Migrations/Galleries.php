<?php


namespace Migrations;


use Illuminate\Database\Capsule\Manager as Capsule;

class Galleries
{

    public static function up()
    {
        Capsule::schema()->create("galleries", function ($table) {
            $table->id();
            $table->string("entry_name");
            $table->integer("entry_id");
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists("galleries");
    }


}