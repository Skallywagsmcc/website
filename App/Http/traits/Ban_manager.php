<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


use App\Http\Models\Bans;

class Ban_manager implements \App\Http\Interfaces\bannings
{

    public $status;
    public $ban;
    public $expire;

    public function checkexpire()
    {
        if($this->status == true)
        {

        }
        else
        {
            echo "failed";
        }
    }


}