<?php


namespace App\Http\Packages\Authentication;


use App\Http\Models\User;

class Register
{
    public static $id;
    public static $ValidEmail;
    public static $ValidPassword;
    public static $ValidUser;

    protected static $username;
    protected static $password;
    protected static $confirm;
    protected static $email;

    public static function ValidateEmail($email)
    {
//        We will validate the email address  here
        $users = User::where("email", $email)->get();
        if ($users->count() == 1) {
            self::$ValidEmail = true;
        } else {
            self::$ValidEmail == false;
//           Save Data to database
            $user = new User();
            $user->tfa = true;
            $user->email = $email;
            $user->status = "pending";
            $user->expires = time() + 3600;
            $user->save();
            self::$id = $user->id;
        }
        return new static();
    }

    public function EmailConfirmation()
    {
//        Add this tomorrow;
        $value = "Password emailed";
        return $this;
    }


    public function GeneratePassword($password, $id = null)
    {
        if ((is_null($id)) || ($id == null)) {
            $id = self::$id;
        }
        $user = User::find($id);
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        return $this;
    }

    public function Redirect($location)
    {
        return header("location: $location");
    }


}