<?php


namespace App\Http\Packages\Authentication;


class Cookies
{

    public Static function Create($name,$value,$days)
    {
        setcookie($name,$value,time()+3600*24*$days,"/",".". $_SERVER['HTTP_HOST']);
    }

    public Static function Destroy($name,$value,$days)
    {
        setcookie($name,$value,time()-3600*24*$days,"/",".". $_SERVER['HTTP_HOST']);
    }
    
}