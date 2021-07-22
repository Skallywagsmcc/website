<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Member;
use App\Http\Models\Profile;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class UsersController
{

    public function index(Url $url)
    {
        $users = User::all();
        $latest = User::orderBy("id","DESC")->take(5)->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "latest"=>$latest, "url" => $url]);
    }

    public function create(URL $url)
    {
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["users" => $users, "url" => $url]);
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
//            if ($validate->Post("randompw") == 1) {
//                $user->password = bin2hex(random_bytes(6));
//            } else {
//            Password is required Disabled Random Password for time  being to allow site functionality
//            No email has been setup to be sent out.
                $user->password = $validate->Required("password")->Post();
                $validate->HasStrongPassword($user->password);
//            }

if($validate->Post("password") === $validate->Post("confirm-password")) {
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
                $users->password = password_hash($validate->Post("password"), PASSWORD_DEFAULT);
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

                if ($validate->Post("make_member") == 1) {
//                    Will check if the member does not exist and will create a new one;
                    $member = new Member();
                    $member->user_id = $users->id;
                    $member->save();
                } else {
                }
                redirect($url->make("auth.admin.users.home"));
            }
        }
    }
}
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.new", ["user" => $user, "url" => $url, "error" => $error, "values" => Validate::$values, "validpw" => $validate::$ShowRequirments]);

    }

    public function search(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];


        $users = User::wherehas("Profile", function ($q) use ($keyword) {
            $q->where("first_name", "LIKE", "%$keyword%")->orwhere("last_name", "LIKE", "%$keyword%");
        })->orwhereRaw('MATCH (username,email) AGAINST (?)', array($keyword))->orwhere("username","LIKE","%$keyword%")->get();

        if($users->count() == 0)
        {
            $message = "No Username With that Name has Been found in our database";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Users.index", ["users" => $users, "url" => $url,"message"=>$message]);


    }

    public function edit($id, $username, Url $url)
    {
        $id = base64_decode($id);
        $username = base64_decode($username);
        $user = User::withCount("settings")->where("id", $id)->where("username", $username)->get();
        $members = $user->first()->Members()->where("user_id", $user->first()->id)->get();

        if ($user->count() == 1) {
            echo TemplateEngine::View("Pages.Backend.AdminCp.Users.edit", ["user" => $user->first(), "url" => $url, "members" => $members]);
        } else {
            echo "user} doesnt exisit";
        }


    }

    public function update(Url $url, Csrf $csrf, Validate $validate)
    {
//Get validation

        if ($csrf->Verify() == true) {
            $validate = new Validate();
            $id = $validate->Post("id");
            $user = User::find($validate->Post("id"));
            $user->email = $validate->Required("email")->Post();
            $user->is_admin = $validate->Post("is_admin");
            $user->save();
//
            $profile = Profile::find($user->id);
            $profile->first_name = $validate->Required("first_name")->Post();
            $profile->last_name = $validate->Required("last_name")->Post();
            $profile->save();


            if ($validate->Post("make_member") == 1) {
                $member = Member::where("user_id", $id)->get();
                if ($member->count() == 0) {
//                    Will check if the member does not exist and will create a new one;
                    $member = new Member();
                } else {
                    $member = $member->first();
                }
                $member->user_id = $id;
                $member->save();
            } else {
                $member = Member::where("user_id", $validate->Post("id"));
                $member->delete();
            }

            redirect($url->make("auth.admin.users.home"));
        }

    }

    public function delete($id, Url $url)
    {
        $user = User::where("id",$id);
        if($user->count() == 1) {
            UserSettings::where("user_id", $id)->delete();
            Profile::where("user_id", $id)->delete();
            Member::where("user_id", $id)->delete();


//        FInd Images and delete them
            $images = Image::where("user_id", $id);
            if($images->count() >= 1) {
                foreach ($images as $image) {
                    unlink(__DIR__ . "/../../../../img/uploads/$image->image_name");
                    Image::find($image->id)->delete();
                    FeaturedImage::where("image_id", $image_id)->delete();
                }
            }
//            finally delete the users account;
            $user->delete();
        }
        else
        {
            echo "no user found";
        }
        redirect($url->make("auth.admin.users.home"));

    }


}