<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Comment;
use App\Http\Models\User;

class CommentsController
{



    public function create()
    {

    }

    public function store(Csrf $csrf)
    {
        if($csrf->Verify() == true)
        {
            $validate = new Validate();
            $comment = new Comment();
            $this->entry_name = $validate->Post("entry_name");
            $this->entry_id = $validate->Post("entry_id");
            $comment->user_id = Auth::id();
            $comment->image_id = $validate->Post("id");
            $comment->comment = $validate->Post("comment");
            $comment->save();
            redirect($_SERVER['HTTP_REFERER']);
        }

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