<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Likes extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}