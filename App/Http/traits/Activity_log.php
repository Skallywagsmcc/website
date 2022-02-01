<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;

use App\Http\Models\ActivityLog;
use Illuminate\Database\Capsule\Manager;

trait Activity_log
{

    use Authentication;

    public function UserActivity()
    {
        return ActivityLog::where("user_id",$this->loggedinuser()->id)->get();
    }

}