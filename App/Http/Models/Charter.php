<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Charter extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Image()
    {
        return $this->hasOne(Image::class,"id","thumbnail");
    }

//    this will be linked to the events cover image
    public function CoverImage()
    {
        return $this->hasOne(Image::class,"id","cover");
    }

}