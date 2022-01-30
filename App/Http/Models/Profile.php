<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Profile extends Controller
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Image()
    {
        return $this->hasOne(Image::class,"id","profile_pic");
    }
    public function Cover()
    {
        return $this->hasOne(Image::class,"id","cover");
    }
}