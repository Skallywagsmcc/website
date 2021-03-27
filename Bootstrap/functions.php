<?php

function slug($slug)
{
    return str_replace(" ","-",$slug);
}


function redirect($location)
{
    return header("location:$location");
}

function rmimg($file)
{
    return unlink(\App\Http\Libraries\ImageManager\Images::$upload_dir.$file);
}


function Auth()
{
return \App\Http\Libraries\Authentication\Auth::Loggedin() == true;
}



