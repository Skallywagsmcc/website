<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Address extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}