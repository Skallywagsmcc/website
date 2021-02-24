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



}