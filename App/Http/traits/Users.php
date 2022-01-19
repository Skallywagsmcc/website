<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\Token;
use App\Http\Models\User;
use App\Http\Models\UserSettings;

trait Users
{


    public function findusers($id)
    {
        return User::where("id", $id)->get();
    }


    public function deleteUser($id)
    {
        $user = User::where("id", $id);
        $user->count() == 1 ? $user = $user->get()->first() : exit("User Not found");

//        this will only continue if the user doesnt exisit;
        UserSettings::where("user_id", $id)->delete();
        Profile::where("user_id", $id)->delete();

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                unlink(__DIR__ . "/../../../img/uploads/$image->image_name");
                Image::find($image->id)->delete();
                FeaturedImage::where("image_id", $image_id)->delete();
            }
//                When Applied into the code will need to delete the users gallery.

//                Delete any csrf tokens by user.
        }

        $user->delete();
    }


    public function userexists($value)
    {
        $user = User::where("email",$value)->orwhere("username",$value)->get();
        if($user->count() == 1)
        {
           return true;
        }
        else
        {
            return false;
        }
    }



    public function DeleteUserRequest($user_id, $token_hex, $token_key)
    {
        $request = Token::where("user_id", $user_id)->where("entity_name", $this->entity_name)->where("token_hex", $token_hex)->where("token_key", $token_key);
        if ($request->count() == 1) {
            Profile::where("user_id", $user_id)->delete();
            UserSettings::where("user_id", $user_id)->delete();
            User::where("id", $user_id)->delete();
            if($request->delete()) {
                return true;
            }
        }
    }


}