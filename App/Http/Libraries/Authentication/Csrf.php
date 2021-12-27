<<<<<<< HEAD
<?php

namespace App\Http\Libraries\Authentication;

use App\Http\Functions\Validate;
use App\Http\Models\Profile;
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
        if($auth->id())
        {
            $this->id = $auth->id();
        }
        $this->entity_name = "request/csrf";
        $this->token_hex = bin2hex(random_bytes(32));
        $this->token_key = rand(00000,10000)."-".rand(00000,100000);
    }

    public function FindToken($user_id)
    {
//        $this->id  must be instantiated in order to work;
        $this->token = Token::where("entity_name", $this->entity_name)->where("user_id", $user_id)->get();
    }



//    public function ValidExpire()
//    {
//        $this->FindToken($this->id);
//
//        $today = date("Y-m-d H:i:s");
//        if ($this->token->count == 1) {
//            if ($today > date("Y-m-d H:i:s", strtotime($this->->first()->expires))) {
//                echo "your token has expired Please regenerate one";
//            } else {
//                echo "Not expired";
//            }
//        }
//    }

    public function GenerateToken($user_id)
    {
//        load the token
        $this->FindToken($user_id);
//        count the token
        $this->token->count() == 1 ?  $this->UpdateToken($this->token->first()->id): $this->NewToken($user_id);

    }


//
    public function UpdateToken($id)
    {
        $token = Token::where("id", $id)->where("entity_name", "$this->entity_name")->get()->first();
        $token->token_hex = $this->token_hex;
        $token->token_key = $this->token_key;
        $token->expires = $this->NewExpiry("15 mins");
        $token->save();
    }


    public function NewToken($user_id)
    {

        $token = new Token();
        $token->user_id = $user_id;
        $token->entity_name = $this->entity_name;
        $token->token_hex = $this->token_hex;
        $token->token_key = $this->token_key;
        $token->expires = $this->NewExpiry("15 mins");
        $token->save();
    }

    public function NewExpiry($params = null)
    {
        if (is_null($params)) {
            return $this->expires = date("Y-m-d H:i:s");
        } else {
            return $this->expires = date("Y-m-d H:i:s", strtotime($params));
        }
    }

    public function Key()
    {

        $this->FindToken($this->id);
        if($this->token->count() == 1)
        {
            echo "<input type='text'  readonly name='csrf' value='".$this->token->first()->token_hex."' id='csrf'>";
        }
    }

//
//
//    /*Need to generate a verification based on sessions for login and register form when not logged in*/
//
    public function Verify()
    {
        $validate = new Validate();
        $this->FindToken($this->id);
        if ($this->token->count() == 1) {
//            Verify the code matches
            if ($validate->Post("csrf") == $this->token->first()->token_hex) {
                $this->GenerateToken($this->id);
                return true;
            } else {
                return false;
            }

        }
    }
}