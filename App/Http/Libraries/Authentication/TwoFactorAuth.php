<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Models\User;

class TwoFactorAuth
{

//Add a back location to go backward  and forwards locations
    public static function TfaCheck($back,$forward)
    {
        if(User::where("id",$_SESSION['id'])->get()->count() == 0)
        {
            redirect($back);
        }
        else
        {
            if(!isset($_SESSION['RequireTfa']) || $_SESSION['RequireTfa'] == true)
            {
                redirect($back);
            }
            else
            {
                redirect($forward);
            }
        }
    }

    private static $code;

    public static function ObtainHex($user_id)
    {
        return \App\Http\Models\TwoFactorAuth::where("user_id", $user_id)->get()->first();
    }

    public static function CheckStatus()
    {
//        This needsx to be middleware rather than a  function
        $user = User::where("id",$_SESSION['id'])->get()->first();
        if ($user->two_factor_auth == 1) {
            if ((isset($_SESSION['RequireTfa'])) && ($_SESSION['RequireTfa'] == true)) {
                header("location:/auth/tfa");
            } else {
                echo "Two Factor Authentication has been approved and you can carry on";
            }
        }
        else
        {
            Sessions::Destroy("RequireTfa");
        }
    }

    public static function GenerateCode($user_id)
    {
        $tfa = new \App\Http\Models\TwoFactorAuth();
        $tfa->user_id = $user_id;
        $tfa->hex = self::bin2hexGen();
        $tfa->code = rand(000000, 999999);
        $tfa->expire = time() + 56;
        $tfa->save();
        self::$code = $tfa->code;
    }

    private static function bin2hexGen()
    {
        return base64_encode(bin2hex(random_bytes(32)));
    }

    public static function __getCode()
    {
        return self::$code;
    }

    public static function UpdateTwoFactorAuth($id)
    {
        $tfa = \App\Http\Models\TwoFactorAuth::find($id);
        $tfa->hex = self::bin2hexGen();
        $tfa->code = rand(000000, 999999);#
        $tfa->save();

        self::$code = $tfa->code;
    }

    public static function CountAuths($id)
    {
        return \App\Http\Models\TwoFactorAuth::where("user_id", $id)->get()->count();
    }


    public static function GetTwoFactorAuth()
    {
        if (isset($_SESSION['id'])) {
            $tfas = \App\Http\Models\TwoFactorAuth::where("user_id", $_SESSION['id'])->get();
            $count = $tfas->count();
            if ($count == 1) {
                echo "We Found the code we need";
            } else {
                Authenticate::$errmessage = "Sorry the user cannot be found";
            }
        }
    }

}