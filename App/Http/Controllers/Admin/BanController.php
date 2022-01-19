<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\Controllers\Admin;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Bans;
use App\Http\Models\User;
use App\Http\traits\Ban_manager;
use MiladRahimi\PhpRouter\Url;

class BanController
{
    use Ban_manager;

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
        $ban = Bans::Orderby("id", "ASC");
        $paginator = new LaravelPaginator("5", "page");
        if ($ban->count() == 0) {
            echo "No ban results found";
        } else {
            echo "results found";
        }

    }

    public function store(Url $url, $username,Csrf $csrf,Validate $validate)
    {

        if($csrf->Verify() == true) {
            $this->username = $username;
            $user = User::where("username", $this->username)->get();
            if ($validate->HasStrongPassword($validate->Post("admin_pw")) == false) {
                echo "An Error occurred Passwored doesnt match";
            } elseif ($user->count() == 1) {
                $user = $user->first();
                $bans = Bans::where("user_id", $user->id)->get();
                if ($bans->count() == 0) {
                    $bans = new Bans();
                    $bans->user_id = $user->id;
                    $bans->expires = date("Y-m-d H:i:s", strtotime($this->expire));
                    $bans->save();
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->error = "A Ban is already in place";
                }
            } else {
                $this->error = "No User can be found";
            }
            echo $this->error;
        }
        else
        {
            echo "csrf token does not match";
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);
        if($this->RemoveBan($id) == true)
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            echo "Ban Request failed to delete";
        }
    }

}