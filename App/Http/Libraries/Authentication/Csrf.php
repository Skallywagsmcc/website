<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Functions\Validate;
use App\Http\Models\Token;
use App\Http\Models\User;

class Csrf extends Auth
{

    protected $key;

    public function __construct()
    {
        $this->checkexpire();
    }

    public function checkexpire()
    {
            if ((User::where("id", self::id())->get()->count() == 1)) {
                if (isset($_SESSION['csrf_expire']) && (time() > $_SESSION['csrf_expire'])) {
                    $this->GenerateToken(self::id());
                    echo "its expired";
                }
                else
                {
                    echo "the code hasnt expired";
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
        $_SESSION['csrf_expire'] = time() + 60 * 5;
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
        $id = self::id();
        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            echo "<input type='text'  name='csrf' value='" . $user->csrf->key . "' id='csrf'>";
        }
    }

    /*Need to generate a verification based on sessions for login and register form when not logged in*/

    public function Verify()
    {
        $validate = new Validate();
        $user = User::where("id", self::id())->get();
        if ($user->count() == 1) {
                $user = $user->first();
                $token = $user->csrf()->where("key", $validate->Post("csrf"))->get()->first();
//            Verify the code matches
                if ($validate->Post("csrf") == $token->key) {
                    $this->GenerateToken(self::id());
                    echo "valid";
                    return true;
                } else {
                    exit("invalid Token found");
                }

        }


    }
}