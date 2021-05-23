<?php


namespace App\Libraries\LikesManager;


use App\Http\Models\Likes;

class Base
{

    public function GetLikes($entry_name, $entry_id)
    {
        return Likes::where("entry_name", $entry_name)->where("entry_id",$entry_id)->get();
    }


}