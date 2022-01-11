<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\Controllers\Admin;


use App\Http\Functions\Validate;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Bans;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class BanController
{

    public $expire;
    public $username;
    public $reason;
    public $error;
    public $request;

    public function __construct(Validate $validate)
    {
        $this->expire = $validate->Post("expire");

    }


    public function index(Url $url)
    {
        $ban = Bans::Orderby("id","ASC");
        $paginator = new LaravelPaginator("5","page");
        if($ban->count()==0)
        {
            echo "No ban results found";
        }
        else
        {
            echo "results found";
        }

    }

    public function store(Url $url,$username)
    {
        $this->username = $username;
        $user = User::where("username",$this->username)->get();
        if($user->count() == 1)
        {
            $user = $user->first();
            $bans = Bans::where("user_id",$user->id)->get();
            if($bans->count() == 0)
            {
                $bans = new Bans();
                $bans->user_id = $user->id;
                $bans->expires = date("Y-m-d H:i:s",strtotime($this->expire));
                $bans->save();
                redirect($url->make("auth.admin.users.ban.home"));
            }
            else
            {
                $this->error = "A Ban is already in place";
            }
        }
        else
        {
            $this->error = "No User can be found";
        }
        echo $this->error;
    }

}