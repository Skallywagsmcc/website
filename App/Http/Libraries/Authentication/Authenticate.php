<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Models\User;

class Authenticate extends Auth
{

//    Valid Valies
    public static $id;
    public static $ValidateEmail;
    private static $withuser;
    private static $withemail;
    private static $withpassword;

//Get post requests
    private static $username;
    private static $email;
    private static $password;


// end requests

    public static function Auth()
    {
//    Set all the values to
        self::$withuser = false;
        self::$withemail = false;
        self::$withpassword = false;
        return new static();
    }

    public function WithUser($username)
    {
        self::$withuser = true;
        self::$username = $username;
        return $this;
    }

    public function WithEmail($email)
    {
        self::$withemail = true;
        self::$email = $email;
        return $this;
    }

    public function WithPassword($password)
    {

        self::$withpassword = true;
        self::$password = password_hash($password,PASSWORD_DEFAULT);
        return $this;
    }


// Registration

    public function Register($redirect = null)
    {
        $user = new User();
      if(self::$withuser == true)
      {
          $user->name = self::$username;
      }
      if(self::$withemail == true)
      {
         $user->email = self::$email;
      }
      if(self::$withpassword == true)
      {
          $user->password = self::$password;
      }
        $user->save();
//        if ((is_null($redirect)) || ($redirect == null)) {
//            header("location:/auth/register/success");
//        } else {
//            header("location:$redirect");
//        }
        ¬
        return $this;
    }


    public static function ValidateEmail($email)
    {
        return User::where("email",$emaiil)->get()->count();
    }

    public static function ValidateUser($username)
    {
        return User::where("username",$username)->get()->count();
    }





//    end registration script


//    Login section

    public function Login()
    {

    }

//    end login script

//    Reset Passwords


}