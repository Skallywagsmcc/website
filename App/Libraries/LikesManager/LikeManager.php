<?php


namespace App\Libraries\LikesManager;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Likes;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class LikeManager
{

    public $entry_name;
    public $entry_id;
    public $like_url;
    public $unlike_url;

    public function __construct($entry_name, $entry_id, $like_url, $unlike_url)
    {
        $this->entry_name = $entry_name;
        $this->entry_id = $entry_id;
        $this->like_url = $like_url;
        $this->unlike_url = $unlike_url;
    }

//    Requires the user to request the class name or some other form of entry name

    public function GetClass()
    {
        return $this->entry_name;
    }

    public function Links()
    {
        if (User::where("id", Auth::id())->count() == 1) {
            if ($this->Likes()->where("user_id", Auth::id())->count() == 1) {
                echo "<a href=" . $this->unlike_url . ">Unlike</a>";
            } else {
                echo "<a href=" . $this->like_url . ">Like</a>";
            }
        }
//        Search by user  entry name and entry id;
    }

    public function Likes()
    {
        return Likes::where("entry_name", $this->entry_name)->where("entry_id", $this->entry_id)->get();
    }



}