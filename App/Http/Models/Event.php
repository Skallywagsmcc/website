<?php


namespace App\Http\Models;


class Event extends \App\Http\Controllers\Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}