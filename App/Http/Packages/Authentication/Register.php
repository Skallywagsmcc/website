<?php


namespace App\Http\Packages\Authentication;


use App\Http\Functions\BladeEngine;
use App\Http\Models\User;
use Dotenv\Loader\Loader;

class Register
{
    public static $id;
    protected static $username;
    protected static $password;
    protected static $confirm;
    protected static $email;


    public static $ValidEmail;
    public static $ValidPasswords;

    public static function ValidateEmail($email)
    {
//        We will validate the email address  here
        $users = User::where("email",$email)->get();
        if($users->count() == 1)
        {
            self::$ValidEmail = true;
        }
        else
        {
            self::$ValidEmail == false;
//           Save Data to database
            $user = new User();
            $user->tfa = true;
            $user->email = $email;
            $user->status = "pending";
            $user->expires = time()+3600;
            $user->save();
            self::$id = $user->id;

        }
            return new static();
    }


    public function redirect($location)
    {
        return header("location: $location");
    }

    public function View($location,$values=null)
    {
        if(self::$ValidEmail == false)
        {
            echo BladeEngine::View($location,$values);
        }

    }


    


    public static function preprocess()
    {
     if( (self::IsValidUser() == 1) or (self::IsValidEmail() == 1))
     {
         header("location:/auth/login");
         exit();
     }
     else
     {
         Passwords::ConfirmPwd();
     }
    }
    public static function Create($username, $email, $password,$confirm)
    {
        self::$username = $username;
        self::$password = $password;
        self::$email = $email;
        self::$confirm = $confirm;
        self::preprocess();
//       check for hashes password results
        self::ProcessRegister();
        return new static();
    }

    public static  function ProcessRegister()
    {
        $user = new User();
        $user->tfa = true;
        $user->username = self::$username;
        $user->email = self::$email;
        $user->password = Passwords::$hash;
        Passwords::$IsValidPassword == true ? $user->save() : false;
    }



//    CHeck for password match

//check for Password strengh

//Create New User

    public static function IsValidUser()
    {
      return User::where("username", self::$username)->get()->count();
    }

    public static function IsValidEmail()
    {
        return User::where("email", self::$email)->get()->count();
    }


}