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
    public static $errmessage;

//Get post requests
    private static $username;
    private static $email;
    private static $password;
//end requests

//    Pre validation

    public static function ValidateEmail($email)
    {
        return User::where("email",$email)->get()->count();
    }


    public static function ValidateUser($username)
    {
        return User::where("username",$username)->get()->count();
    }


//End Prevalidation

// Registration

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
        if ((is_null($redirect)) || ($redirect == null)) {
            header("location:/auth/register/success");
        } else {
            header("location:$redirect");
        }
        return $this;
    }



//    end registration script


//    Login section


public function Redirect($value)
{
    header("locatipn:$value");
    return $this;
}


    public function Login()
    {
        $users = User::where("username",self::$username)->orwhere("email",self::$username)->get();
        $user = $users->first();
        if($users->count() == 1)
        {
//          Create the session

//            Create csrf token

//            Check for 2factor auth and redirect
        else
        {
            self::$errmessage = "user Doesnt exisit";
        }
        return $this;
/*what is needed
)

 Validate the users
 Search for the user information and pull it from the database
 verify the password witht he database
 create a csrf token
 allow it to accept csrf code and create a session or cookie
if 2fa is not enabled then just create a session or cookie

*/

    }

//    end login script

//    Reset Passwords


}