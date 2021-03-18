<?php


namespace App\Http\Models;


class Image extends \App\Http\Controllers\Controller
{

    public function comments()
    {
        return $this->hasMany(ImageComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}