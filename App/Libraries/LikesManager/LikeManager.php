<?php


namespace App\Libraries\LikesManager;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Likes;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class LikeManager
{

    public $uuid;
    public $like_url;
    public $unlike_url;


//    Requires the user to request the class name or some other form of entry name


    public function Links($uuid)
    {


        if (User::where("id", Auth::id())->count() == 1) {
            if (Likes::where("uuid",$uuid)->where("user_id",Auth::id())->count() == 1) {
                      echo '<a href="/manage/likes/delete/'.$uuid.'">unlike</a>';
            }
            else
            {
                echo '<a href="/manage/likes/add/'.$uuid.'">Like</a>';
            }
        }
//        Search by user  entry name and entry id;
    }

    public function Likes($uuid)
    {
        return Likes::where("uuid",$uuid)->get();
    }



}