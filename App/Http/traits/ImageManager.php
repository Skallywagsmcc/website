<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


use App\Http\Models\Image;

trait ImageManager
{


    public function FindImage($id)
    {
        $image = Image::where("id","$id")->get();
        if($image->count() == 1)
        {
            $image = $image->first();
        }
        return $image;
    }

    public function RmImage($id)
    {
        return $this->FindImage($id)->delete();
    }

}