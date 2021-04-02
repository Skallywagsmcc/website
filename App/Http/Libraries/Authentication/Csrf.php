<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Models\Token;
use App\Http\Models\User;
use DateTime;

class Csrf extends Auth
{

    public function __construct()
    {
        self::Token();
    }

    public function Token()
    {
        $id = $_SESSION['id'];
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if (isset($id)) {
            $result = User::where("id", $id)->get();
            $user = $result->first();
            $count = $result->count();
//            check for expiration
            $current = new DateTime();
            $expires = new DateTime($user->Token->expires);
            if(empty($user->Token->key))
            {
                self::GenerateToken($id);
            }
            elseif ($current->format("d/m/Y H:i:s") > $expires->format("d/m/Y H:i:s")) {
//                After 2 minutes it will regernerate a new code.
                self::GenerateToken($id);
            } else {
                if (isset($_POST['csrf'])) {
                    if ($_POST['csrf'] === $user->Token->key) {
//                    generate a new code on submit
                    } else {
                        exit("invalid Token");
                    }
                }
                else
                {
                }

            }
        }
    }

    public static function GenerateToken($user_id)
    {
//     generate a new token
        $key = bin2hex(random_bytes(32));
//        Search the database for your tokens
        $tokens = Token::where("user_id", $user_id)->get();
        $token = $tokens->first();
        $count = $tokens->count();
        $count == 1 ? self::UpdateToken($token->id, $key) : self::NewToken($user_id, $key);
        return new static();
    }

    public static function UpdateToken($id, $key)
    {
        $token = Token::where("id", $id)->get()->first();
        $token->key = $key;
        $token->expires = self::GenerateExpire();
        $token->save();
    }

    public static function GenerateExpire()
    {
//        Will link Settings to this section allowing people to add there own settings to the expiration
//        the lower the number the more chance of expiration.
        $date = new DateTime();
        return $date->modify("+ 30 min")->format("Y-m-d H:i:s");
    }

    public static function NewToken($user_id, $key)
    {
        $token = new Token();
        $token->user_id = $user_id;
        $token->key = $key;
        $token->expires = self::GenerateExpire();
        $token->save();
    }

    public static function Key()
    {
        $id = $_SESSION['id'];
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            echo "<input type='text'  name='csrf' value='" . $user->Token->key . "' id='csrf'>";
        }
    }
}