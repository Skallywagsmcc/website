<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\User;
use App\Http\Libraries\Authentication\Authenticate;
use MiladRahimi\PhpRouter\Url;

class RegisterController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Auth.Register.index",["url"=>$url]);
    }


    public function store(Url $url)
    {
        $validate = new Validate();
        $user = new User();
        $user->email = $validate->Required("email")->Post();
        $user->password  = $validate->Required("password")->Post();
        $user->confirm = $validate->Required("confirm")->Post();
        $validate->HasStrongPassword($user->password);
        if(Authenticate::ValidateEmail($user->email) == 1)
        {
            $errmessage = "The Email you are registering already Exiists";
        }
        else
        {
//            start
            if($user->password == $user->confirm)
            {
                if(Validate::$ValidPassword == true)
                {
                    Authenticate::Auth()->WithEmail($user->email)->WithPassword($user->password)->Register()->EmailConfirmation($user->email);
                }
                else
                {
                    $errmessage = "Sorry You Have not met the Secure Password Requirments";
                    echo Validate::$ShowRequirments;
                }
            }
            else
            {
                $errmessage = "Sorry The Passwords you have entered do not match, Please try again";
            }

//            end
        }
        echo TemplateEngine::View("Pages.Auth.Register.index",["user"=>$user,"Validation"=>$validate->values,'requirments'=>Validate::$ShowRequirments,"errmessage"=>$errmessage,"url"=>$url]);

    }

    public function delete($i, Url $url)
    {
        $user = User::where("id",$id);
            if($user->get()->count() == 1)
        {
            $user->delete();
        }
            else
        {
            echo "User cannot be found";
        }
    }



}