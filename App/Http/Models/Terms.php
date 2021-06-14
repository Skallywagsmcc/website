<?php
/**
 * This code is created by Martin Bamber of LadsDad:Code, this code is owned by and developed by myself however you are free to use this code if you wish to modify or make better,
 */

namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Terms extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}