<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


use App\Http\Models\Bans;

trait Ban_manager
{

    public $user_id;
    public $ban;

    public $expires;
//    use disableform if for specifics to save clashing with other names
    public $disbaleform;
    public $ban_confirmed;


//    Load is required in order to instantiate the main components of the trait
// $this->ban can then be used in the classes themself when called or in a view eg :  $request->ban->count $request replaced $this as a univesal for all  public properties and methods;
    public function load($user_id = null)
    {
        $this->user_id = $user_id;
        if (is_null($user_id)) {
            $this->ban = Bans::all();
        } else {
            $this->ban = Bans::where("user_id", $this->user_id)->get();
        }
        return $this->ban;
    }

    public function banconfirmed()
    {
        if($this->ban->count() == 1)
        {
            $this->ban_confirmed = true;
            return true;
        }
        else
        {
            $this->ban_confirmed = false;
            return false;
        }

    }


    public function BanExpires()
    {
        return $this->ban->first()->expires;
    }


    public function RemoveBan($id)
    {
        if(Bans::where("user_id",$id)->delete())
        {
            return true;
        }
        else{
            return  false;
        }
    }


}