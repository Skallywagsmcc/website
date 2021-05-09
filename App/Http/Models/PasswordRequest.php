<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class PasswordRequest extends Controller
{

    public function user()
    {
        return $this->belongsto(User::class);
    }
}