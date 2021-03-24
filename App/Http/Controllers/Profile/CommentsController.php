<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Comment;
use App\Http\Models\User;

class CommentsController
{



    public function create()
    {

    }

    public function store()
    {
        $validate = new Validate();
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->image_id = $validate->Post("id");
        $comment->comment = $validate->Post("comment");
        $comment->save();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

        if (User::where("id", Auth::id())->get()->count() == 1) {
            $comment = Comment::where("id", base64_decode($id))->get();
            if ($comment->count() == 1) {
                Comment::find(base64_decode($id))->delete();
                redirect($_SERVER['HTTP_REFERER']);
            }
        }


    }


}