<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}