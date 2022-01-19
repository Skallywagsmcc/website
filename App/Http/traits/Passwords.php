<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


trait Passwords
{

    public function ListPolicy()
    {
        return array(
            "Must be no less that 8 Characters Long",
            "At least One Uppercase Letter",
            "At least One Lowercase Letter",
            "At least One Number",
//Not being used
//            "At least One Special Character (?_#@)"
        );
    }

}