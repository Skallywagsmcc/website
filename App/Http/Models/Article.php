<?php


namespace App\Http\Models;


use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Controller;
use App\Http\Libraries\ImageManager\Images;

class Article extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(Image::class,"id","thumb");
    }

}