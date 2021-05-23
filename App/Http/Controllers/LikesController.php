<?php


namespace App\Http\Controllers;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Likes;
use MiladRahimi\PhpRouter\Url;

class LikesController
{


    public function Create(Url $url,$entry_name,$entry_id,Auth $auth)
    {
        $like = new Likes();
        $like->user_id = Auth::id();
        $like->entry_name = $entry_name;
        $like->entry_id = $entry_id;
        $like->save();
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function Destroy(Url $url,$entry_name,$entry_id,Auth $auth)
    {

        $likes = Likes::where("user_id",$auth::id())->where("entry_name",$entry_name)->where("entry_id",$entry_id);
        if($likes->count() == 1)
        {
            $likes->delete();
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


}