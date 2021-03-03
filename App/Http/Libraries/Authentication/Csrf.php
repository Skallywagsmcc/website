<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Models\Token;
use App\Http\Models\User;

class Csrf
{
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
        $token->save();
    }

    public static function NewToken($user_id, $key)
    {
        $token = new Token();
        $token->user_id = $user_id;
        $token->key = $key;
        $token->save();
    }

    public function Token()
    {
        $id = $_SESSION['id'];
        $csrf = $_POST['csrf'];
        $valid = $_SESSION['valid'];
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if($_SESSION['Valid'] == true)
        {
            if((isset($csrf)) && ($csrf == $user->Token->key) )
            {
                echo "Its a match";
                Sessions::Destroy("Valid");
                header("location:/");
            }
            echo "logged in";
        }
        else
        {
            echo "not logged in";
          Sessions::Create("Valid",true);
        }
    }

    public static function Key()
    {
        $id = $_SESSION['id'];
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            echo "<input type='text' name='csrf' value='" . $user->Token->key . "' id='csrf'>";
        }
    }
}