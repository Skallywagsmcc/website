<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Models\Token;
use App\Http\Packages\Authentication\Sessions;

class Csrf
{
    /*This code needs to be linked with a Token database which means creating foreign keys
      i will do this tomorrow
      */
    public static $expire;

    public static function GenerateToken($user_id)
    {
////        Destroy expire if it has been used
//        if (isset($_SESSION['expire'])) {
//            Sessions::Destroy("expire");
//        }

//     generate a new token
        $key = bin2hex(random_bytes(32));
//        Search the database for your tokens
        $tokens = Token::where("user_id", $user_id)->get();
        $token = $tokens->first();
        $count = $tokens->count();
        $count == 1 ? self::UpdateToken($token->id,$key): self::NewToken($user_id,$key);
        return new static();
    }



    public static function UpdateToken($id, $key)
    {
        $token = Token::where("id",$id)->get()->first();
        $token->key = $key;
        $token->save();
        echo "key updated";

    }

    public static function NewToken($user_id, $key)
    {
        $token = new Token();
        $token->user_id = $user_id;
        $token->key = $key;
        $token->save();
        echo "key Created";
    }

//    public function Expire()
//    {
//        self::$expire = Sessions::New("expire", time() + 3600)->Create();
//        return $this;
//    }

}