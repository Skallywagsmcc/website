<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;

class UsersController
{

    public function index()
    {
        $users = User::all();
        echo BladeEngine::View("Pages.Admin.Users.index", ["users"=>$users]);
    }

    public function create()
    {
        echo BladeEngine::View("Pages.Admin.Users.new",["users"=>$users]);
    }

    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->email = $validate->Required("email")->Post();
        $user->username = $validate->Required("username")->Post();
        $user->password = bin2hex(random_bytes(5));

        Authenticate::Auth()
            ->WithUser($user->username)
            ->WithEmail($user->email)
            ->WithPassword($user->password)
            ->Register()
            ->SendEmail($user->email,$user->username,"Your Account has been created","Emails.newuser",["user"=>$user]);
        redirect("/admin/users");
    }


    public function edit($id)
    {

    }

    public function update()
    {

    }

    public function delete($id)
    {

    }


}