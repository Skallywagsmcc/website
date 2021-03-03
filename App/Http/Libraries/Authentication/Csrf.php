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
        /*
         * innistial code will be created when user is logged in
         * also need to create a  new coloum on table called expire
         * 1. check if it is logged in
         * 2. check if there is an expiration for 5 mins  300ms
         * 3. if expired then generate a new code
         * 4. check against and verify post csrf code with  database code.
         */
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