<?php


namespace App\Http\Models;


class Image extends \App\Http\Controllers\Controller
{

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class,"id","profile_pic");
    }

}