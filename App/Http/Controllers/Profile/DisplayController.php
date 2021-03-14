<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\BladeEngine;
use App\Http\Models\User;

class DisplayController
{
//    This controlle Will be used for displaying the profile infirmation


public function index($username)
{
    $user = User::where("username",$username)->get();
    $count = $user->count();
    $user = $user->first();
    echo BladeEngine::View("Pages.Profile.index",["user"=>$user]);
}


}