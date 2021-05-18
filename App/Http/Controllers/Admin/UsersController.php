<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Profile;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use MiladRahimi\PhpRouter\Url;

class UsersController
{

    public function index(Url $url)
    {
        $users = User::all();
        echo TemplateEngine::View("Pages.Admin.Users.index", ["users" => $users, "url" => $url]);
    }

    public function create(URL $url)
    {
        echo TemplateEngine::View("Pages.Admin.Users.new", ["users" => $users, "url" => $url]);
    }

    public function store(Url $url, Csrf $csrf, Validate $validate)
    {
        if ($csrf->Verify() == true) {
            $validate = new Validate();
            $user = new User();
            $user->email = $validate->Required("email")->Post();
            $user->username = $validate->Required("username")->Post();
            $user->first_name = $validate->Required("first_name")->Post();
            $user->last_name = $validate->Required("last_name")->Post();
            if ($validate->Post("randompw") == 1) {
                $user->password = bin2hex(random_bytes(6));
            } else {
                $user->password = $validate->Required("password")->Post();
                $validate->HasStrongPassword($user->password);
            }


            if (User::where("username", $user->username)->get()->count() == 1) {
                $error = "that username is already taken";
            } elseif (User::where("email", $user->email)->get()->count() == 1) {
                $error = "That Email Address is already Taken";
            } else {
                if ($validate::Array_Count(Validate::$values) == false) {
                    $error = "invalid field";
                } else {
                    if ($validate::$ValidPassword == true) {

                        $users = new User();
                        $users->username = $validate->Post("username");
                        $users->email = $validate->Post("email");
                        $users->username = password_hash($validate->Post("password"),PASSWORD_DEFAULT);
                        $users->save();

                        $user->username = $validate->Post("username");
                        $profile = new Profile();
                        $profile->user_id = $users->id;
                        $profile->first_name = $user->first_name;
                        $profile->last_name = $user->last_name;
                        $profile->save();

                        $settings = new UserSettings();
                        $settings->user_id = $users->id;
                        $settings->two_factor_auth = 1;
                        $settings->display_full_name = 1;
//            if display full name = 0 then display username;
                        $settings->display_dob = 1;
                        $settings->display_email = 1;
                        $settings->save();

                        redirect($url->make("admin.users.home"));
                    }
                }
            }
        }


        echo TemplateEngine::View("Pages.Admin.Users.new", ["user" => $user, "url" => $url, "error" => $error, "values" => Validate::$values, "validpw" => $validate::$ShowRequirments]);

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
            echo TemplateEngine::View("Pages.Admin.Users.edit", ["user" => $user->first(), "url" => $url]);
        } else {
            echo "Article doesnt exisit";
        }


    }

    public function update(Url $url, Csrf $csrf)
    {
//Get validation

        if ($csrf->Verify() == true) {
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

    }

    public function delete($id, Url $url)
    {
        $user = User::find($id);
        $user->delete();
        redirect($url->make("admin.users.home"));
    }


}