<?php


namespace App\Http\Packages\Authentication;


use App\Http\Models\User;

class Register
{
    protected static $isValid;
    protected static $username;
    protected static $password;
    protected static $confirm;
    protected static $email;
    private static $count;

    private static function UserFound()
    {
        echo "No User found";
    }


    public static function Create($username, $email, $password,$confirm)
    {
        self::$username = $username;
        self::$password = $password;
        self::$email = $email;
        self::$confirm = $confirm;
       self::IsValidUser() == 0 ? Passwords::ConfirmPwd(self::$password,self::$confirm) : self::UserFound();
//       check for hashes password results
        $user = new User();
        $user->tfa = true;
        $user->username = self::$username;
        $user->email = self::$email;
        $user->password = Passwords::$hash;
        Passwords::$IsValidPassword == true ? $user->save() : false;
        return new static();
    }



//    CHeck for password match

//check for Password strengh

//Create New User

    public static function IsValidUser()
    {
        self::$count = User::where("username", self::$username)->orwhere("email", self::$email)->get()->count();
        return self::$count;
    }

}