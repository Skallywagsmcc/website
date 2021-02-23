<?php


namespace App\Http\Packages\Authentication;


class Passwords
{

    public static $IsValid;
    public static $hash;
    public static $IsValidPassword;

    public static function ConfirmPwd($password, $confirm)
    {
        return $password == $confirm ? self::CheckStrength($password) : false;
    }

    public static function CheckStrength($password)
    {
// Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
//        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
//            Password error
        } else {
            self::HashPwd($password);
        }
    }

    public static function HashPwd($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash) {
            self::$hash = $hash;
            self::$IsValidPassword = true;
        } else {
            self::$IsValidPassword = false;
        }
    }
}