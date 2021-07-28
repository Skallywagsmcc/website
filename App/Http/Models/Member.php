<?php


namespace App\Http\Models;


class Member extends \App\Http\Controllers\Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }






}