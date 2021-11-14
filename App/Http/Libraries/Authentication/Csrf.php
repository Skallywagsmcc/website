<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Functions\Validate;
use App\Http\Models\Token;
use App\Http\Models\User;
use mbamber1986\Authclient\Auth;

class Csrf
{

    protected $id;
    protected $key;

    public function __construct()
    {
        $this->checkexpire();
        $auth = new Auth();
        $this->id = $auth->id();
    }

    public function checkexpire()
    {
        if ((User::where("id", $this->id)->get()->count() == 1)) {
            if (isset($_SESSION['csrf_expire']) && (time() > $_SESSION['csrf_expire'])) {
                $this->GenerateToken(self::id());
//                    echo "its expired";
            } else {
//                    echo "the code hasnt expired";
            }
        }
    }


    public function GenerateToken($id)
    {
        $user = User::find($id);
        $token = $user->csrf()->where("user_id", $user->id)->get();
        $key = $this->set_key();
        $token->count() == 1 ? self::UpdateToken($token->first()->id, $key) : self::NewToken($user->id, $key);
    }

    public function set_key()
    {
        $this->key = bin2hex(random_bytes(32));
        return $this->key;
    }

    public static function UpdateToken($id, $key)
    {
        $token = Token::where("id", $id)->get()->first();
        $token->key = $key;
        $token->save();
        self::GenerateExpire();
    }

    public static function GenerateExpire()
    {
//        Expirattion is now a session and will last for 2 minutes per interval
        $_SESSION['csrf_expire'] = time() + 60 * 60;
    }

    public static function NewToken($user_id, $key)
    {
        $token = new Token();
        $token->user_id = $user_id;
        $token->key = $key;
        $token->save();
        self::GenerateExpire();
    }

    public static function Key()
    {
        $auth = new Auth();
        $id = $auth->id();
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            echo "<input type='hidden'  readonly name='csrf' value='" . $user->csrf->key . "' id='csrf'>";
        }
    }

    public function generatetemp()
    {
        return $_SESSION['key'] = $this->set_key();
    }


    /*Need to generate a verification based on sessions for login and register form when not logged in*/

    public function Verify()
    {
        $validate = new Validate();
        $auth = new Auth();
        $user = User::where("id", $this->id)->get();
        if ($user->count() == 1) {
            $user = $user->first();
            $token = $user->csrf()->where("key", $validate->Post("csrf"))->get()->first();
//            Verify the code matches
            if ($validate->Post("csrf") == $token->key) {
                $this->GenerateToken($auth->id());
                return true;
            } else {
             echo "There is an issue with the csrf token.";
            }

        }


    }

}