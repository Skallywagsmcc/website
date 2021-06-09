<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Models\User;

class TwoFactorAuth extends Auth
{

    private static $code;
    private static $time = 120;

//Add a back location to go backward  and forwards locations


    public static function __getCode()
    {
        return self::$code;
    }

    public static function ObtainHex($user_id)
    {
        return \App\Http\Models\TwoFactorAuth::where("user_id", $user_id)->get()->first();
    }


    public static function GenerateCode($user_id)
    {
        $tfa = new \App\Http\Models\TwoFactorAuth();
        $tfa->user_id = $user_id;
        $tfa->hex = self::bin2hexGen();
        $tfa->code = rand(000000, 999999);
        $tfa->expire = time() + self::$time;
        $tfa->save();
        self::$code = $tfa->code;
    }

    public static function UpdateTwoFactorAuth($id)
    {
        $tfa = User::find(Auth::id())->TwoFactorAuth()->find($id);
        $tfa->hex = self::bin2hexGen();
        $tfa->code = rand(000000, 999999);#
        $tfa->expire = time() + self::$time;
        $tfa->save();

        self::$code = $tfa->code;
    }


    public static function CountAuths($id)
    {
        return \App\Http\Models\TwoFactorAuth::where("user_id", $id)->get()->count();
    }


}