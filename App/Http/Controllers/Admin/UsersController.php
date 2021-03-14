<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Profile;
use App\Http\Models\User;
use App\Http\Models\UserSettings;

class UsersController
{

    public function index()
    {
        $users = User::all();
        echo BladeEngine::View("Pages.Admin.Users.index", ["users" => $users]);
    }

    public function create()
    {
        echo BladeEngine::View("Pages.Admin.Users.new", ["users" => $users]);
    }

    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->email = $validate->Required("email")->Post();
        $user->username = $validate->Required("username")->Post();#
        $user->first_name = $validate->Required("first_name")->Post();
        $user->last_name = $validate->Required("last_name")->Post();
        if ($validate->Post("randompw") == 1) {
            $user->password = bin2hex(random_bytes(6));
        } else {
            $user->password = $validate->Required("password")->Post();
        }

        if (User::where("username", $user->username)->orwhere("email", $user->email)->get()->count() == 1) {
            echo "the user exisits";
        } else {
            Authenticate::Auth()
                ->WithUser($user->username)
                ->WithEmail($user->email)
                ->WithPassword($user->password)
                ->Register();
//            ->SendEmail($user->email,$user->username,"Your Account has been created","Emails.newuser",["user"=>$user]);

            $profile = new Profile();
            $profile->user_id = Auth::$id;
            $profile->first_name = $user->first_name;
            $profile->last_name = $user->last_name;
            $profile->save();

            $settings = new UserSettings();
            $settings->user_id = Auth::$id;
            $settings->two_factor_auth = 1;
            $settings->save();

            redirect("/admin/users");
        }
        echo BladeEngine::View("Pages.Admin.Users.new", ["user" => $user]);

    }

    public function search()
    {
        $keyword = $_POST['keyword'];
        $results = Profile::where("full_name", "LIKE", "%" . $keyword . "%")->get();
        $users = $results->first();
        echo $users->full_name . "<br>";
        echo $users->about;
    }


    public function edit($id, $username)
    {
        $id = base64_decode($id);
        $username = base64_decode($username);
        $user = User::withCount("settings")->where("id", $id)->where("username", $username)->get();
        if ($user->count() == 1) {
            echo BladeEngine::View("Pages.Admin.Users.edit", ["user" => $user->first()]);
        } else {
            echo "Page doesnt exisit";
        }


    }

    public function update()
    {
//Get validation
        $validate = new Validate();
        $user = User::find($validate->Post("id"));
        $user->email = $validate->Required("email")->Post();
        $user->save();
//
        $profile = Profile::find($user->id);
        $profile->first_name = $validate->Required("first_name")->Post();
        $profile->last_name = $validate->Required("last_name")->Post();
        $profile->save();

        $settings = UserSettings::find($user->id);
        $settings->user_id = 0;
        $settings->save();

//
//
////        1 edit user inf
////        2 edit Profile first and last name
////        3 edit settings such as using 2 factor authentciation or emailed newsletters
        redirect("/admin/users");

//        echo $validate->Post('two_factor_auth');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        redirect("/admin/users");
    }


}