<?php


namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function install()
    {
        if(Capsule::schema()->hasTable("tokens"))
        {
            echo "table exists";
        }
        else
        {
            Capsule::schema()->create("tokens",function ($table)
            {
                $table->id();
                $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->string("key");
                $table->timestamps();
            });
        }

    }


}