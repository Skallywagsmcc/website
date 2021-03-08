<?php

function slug($slug)
{
    return str_replace(" ","-",$slug);
}


function redirect($location)
{
    return header("location:$location");
}