<?php
namespace App\Http\Libraries\Authentication;

use App\Http\Functions\Validate;
use App\Http\Models\Token;
use App\Http\Models\User;
use mbamber1986\Authclient\Auth;

class Csrf
{
// Variables;
    private $token;
//    Key values


    protected $id;
    protected $token_hex;
    protected $token_key;
    protected $entity_name;

    private $today;
    private $expire;


    public function __construct()
    {
        $auth = new Auth();
        $this->id = $auth->id();
    }

    public function FindToken()
    {
        $this->id = 1;
        return $this->token = Token::where("user_id", $this->id)->get();
    }

    public function CountToken()
    {
        $this->token = $this->FindToken()->count();
        return $this->token == 1 ? "true" : false;
    }


    public function ValidExpire()
    {

        $today = date("Y-m-d H:i:s");
        if ($this->CountToken() == true) {
            if ($today < date("Y-m-d H:i:s",strtotime($this->FindToken()->expires)))
                {
                    echo  "your token has expired Please regenerate one";
                }
        }

    }






//
//    protected $id;
//    protected $key;
//    public $entity_name;
//
//
////    TODO Update tokens to support an expiry date and entity name
//    public function __construct()
//    {
//        $this->entity_name = "csrf_token";
//        $this->checkexpire();
//        $auth = new Auth();
//        $this->id = $auth->id();
//    }
//
//
//
//    public function checkexpire()
//    {
//        if ((User::where("id", $this->id)->get()->count() == 1)) {
//            if (isset($_SESSION['csrf_expire']) && (time() > $_SESSION['csrf_expire'])) {
//                $this->GenerateToken(self::id());
////                    echo "its expired";
//            } else {
////                    echo "the code hasnt expired";
//            }
//        }
//    }
//
//
//    public function GenerateToken($id)
//    {
//        $user = User::find($id);
//        $token = $user->csrf()->where("user_id", $user->id)->get();
//        $key = $this->set_key();
//        $token->count() == 1 ? self::UpdateToken($token->first()->id, $key) : self::NewToken($user->id, $key);
//    }
//
//    public function set_key()
//    {
//        $this->key = bin2hex(random_bytes(32));
//        return $this->key;
//    }
//
//    public static function UpdateToken($id, $key)
//    {
//        $token = Token::where("id", $id)->get()->first();
//        $token->key = $key;
//        $token->expires = date("Y-m-d H:i:s");
//        $token->save();
//        self::GenerateExpire();
//    }
//
//    public static function GenerateExpire()
//    {
////        Expirattion is now a session and will last for 2 minutes per interval
//        $_SESSION['csrf_expire'] = time() + 60 * 60;
//    }
//
//    public static function NewToken($user_id, $key)
//    {
//        $token = new Token();
//        $token->user_id = $user_id;
//        $token->key = $key;
//        $token->expires = date("Y-m-d H:i:s");
//        $token->save();
//        self::GenerateExpire();
//    }
//
//    public static function Key()
//    {
//        $auth = new Auth();
//        $id = $auth->id();
//        $result = User::where("id", $id)->get();
//        $user = $result->first();
//        $count = $result->count();
//        if ($count == 1) {
//            echo "<input type='hidden'  readonly name='csrf' value='" . $user->csrf->key . "' id='csrf'>";
//        }
//    }
//
//    public function generatetemp()
//    {
//        return $_SESSION['key'] = $this->set_key();
//    }
//
//
//    /*Need to generate a verification based on sessions for login and register form when not logged in*/
//
//    public function Verify()
//    {
//        $validate = new Validate();
//        $auth = new Auth();
//        $user = User::where("id", $this->id)->get();
//        if ($user->count() == 1) {
//            $user = $user->first();
//            $token = $user->csrf()->where("key", $validate->Post("csrf"))->get()->first();
////            Verify the code matches
//            if ($validate->Post("csrf") == $token->key) {
//                $this->GenerateToken($auth->id());
//                return true;
//            } else {
//             echo "There is an issue with the csrf token.";
//            }
//
//        }
//
//
//    }

}