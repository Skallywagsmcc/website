<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Image extends Controller
{

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class,"id","user_id");
    }


    public function profile()
    {
        return $this->hasmany(Profile::class, "profile_pic", "id");
    }

    public function page()
    {
        return $this->belongsTo(Article::class);
    }


    public function Featured()
    {
        return $this->hasOne(FeaturedImage::class);
    }



}