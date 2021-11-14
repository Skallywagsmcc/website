<?php


namespace App\Http\Models;


class Event extends \App\Http\Controllers\Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function year()
    {

    }
    public function month()
    {

    }
    public function day()
    {

    }

//    linked to thumbnail
    public function image()
    {
        return $this->hasOne(Image::class,"id","thumbnail");
    }

//    this will be linked to the events cover image
    public function Cover()
    {
        return $this->hasOne(Image::class,"id","cover");
    }

    public function meet()
    {
        return $this->hasOne(Address::class,"id","meet_id");
    }

    public function destination()
    {
        return $this->hasOne(Address::class,"id","dest_id");
    }



}