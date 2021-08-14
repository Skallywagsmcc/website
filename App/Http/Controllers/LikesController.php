<?php


namespace App\Http\Controllers;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Likes;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class LikesController
{


    public function Create(Url $url,$uuid,Auth $auth)
    {
        if(User::where("id",$auth::id())->get()->count() == 1) {
            $like = new Likes();
            $like->user_id = Auth::id();
            $like->uuid = $uuid;
            $like->save();
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            echo "Sorry Permission denied seems you are not logged in";
        }
    }


    public function Destroy(Url $url,$uuid,Auth $auth)
    {
        if(User::where("id",$auth::id())->get()->count() == 1) {
            {
                $likes = Likes::where("user_id", $auth::id())->where("uuid", $uuid);
                if ($likes->count() == 1) {
                    $likes->delete();
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else
                {
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

        }   else
        {
            echo "Sorry Permission denied seems you are not logged in";
        }
    }


}