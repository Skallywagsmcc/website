<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Cookies;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class LoginController
{
    public function index(Url $url)
    {
        $mode = SiteSettings::where("id",1)->get();
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url,"mode"=>$mode]);
    }

    public function store(Url $url, Validate $validate,Csrf $csrf)
    {




        $username = $validate->Required("username")->Post();
        $password = $validate->Required("password")->Post();
        $mode = SiteSettings::where("id",1)->get();

            $user = User::where("username", $username)->orwhere("email", $username)->get();
            if($validate->allowed == false)
            {
                $error = "An Error Occurred Missing fields : ";
                 foreach ($validate->is_required as $required){ $error .="( ". $required . " ) ";
                 }
            }
            else {
                if ($user->count() == 1) {
                    $user = $user->first();
                    if (password_verify($password, $user->password)) {
                        if ($mode->first()->lock_submissions == 1) {
                            $error = "Login is Disabled";
                        } elseif (($user->is_admin == 0) && $mode->first()->open_login == 0) {
                            $error = "Login Restricted to admins";
                        } elseif ($user->disable == 0) {

                            if($validate->Recaptcha(1,0.5,"login") == true) {
                                $csrf->GenerateToken($user->id);
                                $login = User::find($user->id);
                                $login->updated_at = date("Y-m-d H:i:s", strtotime("+1 Hour"));
                                $login->login_attempts = 0;
                                $login->token = bin2hex(random_bytes(32));
                                $login->save();
                                if ($validate->Post("remember") == 1) {
                                    Cookies::Create("token", $login->token)->Days(7)->Path("/")->Http(true)->Save();
                                } else {
                                    Sessions::Create("token", $login->token);
                                }
                                redirect($url->make("account.home"));
                            }
                            else
                            {
                                $error = $validate->captchaerror;
                            }
                        } else {
                            $error = "User login has Been disabled  Click here to reactivate";
                        }

                    } else {
                        $login = User::find($user->id);
                        if ($login->login_attempts > 2) {
                            $login->disable = 1;
                        } else {
                            $login->login_attempts = $user->login_attempts + 1;

                        }
                        $login->save();
                        $max = 3;

                        if ($login->disable == 1) {
                            $error = "Account disabled Please contact support";
                        } else {
                            $error = "Sorry the password does not match our database: Please try again " . ($max - $login->login_attempts) . " Attempts Remaining";
                        }
                    }
                } else {
                    $error = "Sorry the user you have entered does not seem to exist in our database : Please try again";
                }
            }
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url,"error"=>$error,"validate"=>$validate,"username"=>$username,"mode"=>$mode]);


    }

    public function logout(Url $url)
    {

        if(isset($_SESSION['token']))
        {
            Sessions::Destroy("token");
        }

        if(isset($_COOKIE['token']))
        {
            setcookie("token",'',time()-3600,'/');
        }

//        Destroy Other Sessions and cookies
        Sessions::Destroy("tfa_approved");
        Sessions::Destroy("csrf_expire");
            redirect($url->make("login"));


    }

}