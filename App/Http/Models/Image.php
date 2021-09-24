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


//    featured Requests Below

    public function Featured()
    {
        return $this->hasOne(FeaturedImage::class);
    }

    public function count_featured($id)
    {
        return $this->hasOne(FeaturedImage::class)->where("image_id",$id)->count();
    }

    public function fstatus($id)
    {
        return $this->hasOne(FeaturedImage::class)->where("image_id",$id)->get()->first()->status;
    }



}