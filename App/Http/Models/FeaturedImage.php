<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class FeaturedImage extends Controller
{

    public function Image()
    {
        return $this->belongsTo(Image::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class,"uuid","uuid");
    }

}