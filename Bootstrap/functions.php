<?php

use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\ImageManager\Images;

function slug($slug)
{
    return str_replace(" ", "-", $slug);
}


function redirect($location)
{
    return header("location:$location");
}

function rmimg($file)
{
    return unlink(Images::$upload_dir . $file);
}


function Auth()
{
    return Auth::Loggedin() == true;
}


function csrf()
{
    return Csrf::Key();
}


