<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;
use App\Http\Libraries\ImageManager\Images;

class Article extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class,"entry_id","id");
    }

    public function image()
    {
        return $this->hasOne(Image::class,"enrtry_id","id");
    }



}