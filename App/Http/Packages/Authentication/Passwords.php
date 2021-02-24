<?php


namespace App\Http\Packages\Authentication;


use App\Http\Models\User;

class Passwords
{

    public static $password;
    public static $username;
    public static $ValidPassword;


    public static function CheckStrength($password)
    {
// Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
//        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            self::$ValidPassword = false;
        } else {
            self::$password = $password;
            self::$ValidPassword = true;
        }
    }

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