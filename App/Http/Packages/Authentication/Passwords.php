<?php


namespace App\Http\Packages\Authentication;


use App\Http\Models\User;

class Passwords
{

    public static $password;
    public static $username;
    public static $ValidPassword;




    public  function ManagaePassword($id)
    {
      if(self::$ValidPassword == true)
      {
          $user = User::find($id);
          $user->password = password_hash(self::$password,PASSWORD_DEFAULT);
          $user->save();
      }
    }
}