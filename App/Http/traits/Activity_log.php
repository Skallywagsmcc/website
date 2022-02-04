<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;

use App\Http\Models\ActivityLog;
use App\Http\Models\User;
use Illuminate\Database\Capsule\Manager;
use mbamber1986\Authclient\Auth;

trait Activity_log
{

    public $url;
    public $aod;

    use Authentication;

    public function UserActivity()
    {
        return ActivityLog::where("user_id",$this->loggedinuser()->id)->where("aod",0)->where("type","!=","report");
    }

    public function AdminActivity()
    {
        return ActivityLog::where("aod",1)->where("type","!=","report");
    }

    
public function activity_date($date)
{
    return date("d/m/Y : H:ia" ,strtotime($date));
}


    public function addurl($url)
    {
        $this->url = $url;
        return $this;
    }


    public function newactivity($type,$action,$aod=false)
    {
        $auth = new Auth();
        $activity = new ActivityLog();
        $activity->user_id = $auth->id();
        $activity->type = $type;
        $activity->action = $action;
        !is_null($this->url) ? $activity->url = $this->url : $activity->url = null;
        $aod == false ? $activity->aod = 0: $activity->aod = 1;
        $activity->save();
    }

    public function showlink($url,$value=null)
    {
        return "<a href='$url'>$value</a>";
    }


    public function deleteLog($id)
    {
        $id = base64_decode($id);
        $activity = ActivityLog::where("id",$id);
        $activity->delete();
    }

}