<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Profile;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use MiladRahimi\PhpRouter\Url;

class UsersController
{

    public function index(Url $url)
    {
        $users = User::all();
        echo TemplateEngine::View("Pages.Admin.Users.index", ["users" => $users,"url"=>$url]);
    }

    public function create(URL $url)
    {
        echo TemplateEngine::View("Pages.Admin.Users.new", ["users" => $users,"url"=>$url]);
    }

    public function store(Url $url)
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
            $settings->display_full_name = 1;
//            if display full name = 0 then display username;
            $settings->display_dob = 1;
            $settings->email_marketing = 1;
            $settings->save();

            redirect("/admin/users");
        }
        echo TemplateEngine::View("Pages.Admin.Users.new", ["user" => $user,"url"=>$url]);

    }

    public function search(Url $url)
    {
        $keyword = $_POST['keyword'];
        $results = Profile::where("full_name", "LIKE", "%" . $keyword . "%")->get();
        $users = $results->first();
        echo $users->full_name . "<br>";
        echo $users->about;
    }

    public function edit($id, $username, Url $url)
    {
        $id = base64_decode($id);
      $username = base64_decode($username);
        $user = User::withCount("settings")->where("id", $id)->where("username", $username)->get();
        if ($user->count() == 1) {
            echo TemplateEngine::View("Pages.Admin.Users.edit", ["user" => $user->first(),"url"=>$url]);
        } else {
            echo "Page doesnt exisit";
        }


    }

    public function update(Url $url)
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
        redirect($url->make("admin.users.home"));
    }

    public function delete($id,Url $url)
    {
      $user =  User::find($id);
      $user->delete();
        redirect($url->make("admin.users.home"));
    }


}