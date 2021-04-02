<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Page;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class TwoFactorAuthController
{
//Homepage
    public function index(Url $url)
    {
        $user = User::find(Auth::id());
        if(isset($_SESSION['tfa_approved']) && ($_SESSION['tfa_approved'] == 0))
        {
//            display the Blade controller to send the email
            echo TemplateEngine::View("Pages.Frontend.Tfa.index",["url"=>$url,"user"=>$user]);
        }
        else
        {
            redirect($url->make("homepage"));
        }

    }




    public function show(Url $url)
    {
//this section will get the data from the emails and match it request a code.

        if(isset($_SESSION['tfa_expire']))
        {
            if($expire > time())
            {
                redirect($url->make("tfa.index"));
            }
            else
            {
                $user = User::find(Auth::id());
                echo TemplateEngine::View("Pages.Frontend.Tfa.code",["url"=>$url,"user"=>$user]);
            }
        }
        else
        {
        $expire =  $_SESSION['tfa_expire'] = time() + 900;
        }




    }

    public function store(Url $url)
    {
        $validate = new Validate();
        $user = new User();
        $user->code = $validate->Required("code")->Post();
        if($user->code == 123456)
        {
            $_SESSION['tfa_approved'] = 1;
            redirect($url->make("homepage"));
        }
        else{
            echo TemplateEngine::View("Pages.Frontend.Tfa.code",["url"=>$url,"user"=>$user]);
        }
        Authenticate::InsertTwoFactorAuth($user->code);
    }

}