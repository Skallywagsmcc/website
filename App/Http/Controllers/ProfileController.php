<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Profile;
use App\Http\Models\User;

class ProfileController
{

    public function index()
    {
        /*
         * Here we need to do a check if the profile exisits based on the user session  or cookie.
         * if a profile exisits then we can edit.
         * if no profile exisist then informaqtion such as full name will not be visable or searchable in admin panel.
         * if username does not exisit under use it will be editable in the profile settings.
         * two factor authentication will be optional for this section but not for admins;
         *
         */
     $user = User::withCount('Profile')->where("id",$_SESSION['id'])->orwhere("id",$_COOKIE['id'])->get();
     if($user->count() == 1)
        {

            echo BladeEngine::View("Pages.Profile.index",["user"=>$user->first()]);
        }
     else
        {
            redirect("/auth/login");
        }
    }

    public function create()
    {
        echo BladeEngine::View("Pages.Profile.new",["user"=>$user]);
    }

    public function store()
    {
        $validate = new Validate();
        $profile = new Profile();
        $profile->user_id = Auth::id();
        $profile->save();
        redirect("/profile");
    }




}