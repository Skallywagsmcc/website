<?php

function slug($slug)
{
    return str_replace(" ","-",$slug);
}


function redirect($location)
{
    return header("location:$location");
}


function Auth()
{
return \App\Http\Libraries\Authentication\Auth::Loggedin() == true;
}

