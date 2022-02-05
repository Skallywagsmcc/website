<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Cookies;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\traits\Authentication;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class LoginController
{
    use Authentication;

    public $username;
    public $password;
    public $error;
    public $open_registration;

    public function __construct(Validate $validate)
    {
        $this->username = $validate->Post("username");
        $this->password = $validate->Post("password");
        $this->open_registration = false;
    }

    public function index(Url $url, ServerRequest $request)
    {
        $request = array("ref" => $request->getQueryParams()["ref"], "access" => $request->getQueryParams()["access"],"action"=>$request->getQueryParams()["action"]);
        $this->checkopenreg();
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url, "value" => $this, "request" => $request]);
    }

    public function checkopenreg()
    {
        $mode = SiteSettings::where("id", 1)->get();

        if ($mode->count() == 1) {
            $mode = $mode->first();

            if ($mode->open_registration == 1) {
                $this->open_registration = true;
            } else {
                $this->open_registration = false;
            }
        }
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, ServerRequest $request)
    {
        $ref = $request->getQueryParams()["ref"];
//        Add Required
        $user = User::where("username", $this->username)->orwhere("email", $this->username)->get();
//

        $validate->AddRequired(["username", "password"]);

        if ($validate->allowed() == false) {
            $this->error = "Invalid or required Fields";
        }else {
//            Check if the user exisits
            $this->checkopenreg();
            if ($user->count() == 1) {
                $user = $user->first();
//                Verify the password exists and matches the database
                if (password_verify($this->password, $user->password)) {
//                    Do Recaptcha
                    if($user->first()->status <= 1)
                    {
                        $this->error = "Your account has not been activated";
                    }
                elseif ($validate->Recaptcha(1, 0.5, "login") == true) {
//                        Validate a csrf token
                    $csrf->GenerateToken($user->id);
//                        Find the user (again)
                    $login = User::find($user->id);
                    $login->updated_at = date("Y-m-d H:i:s", strtotime("+1 Hour"));
                    $login->login_attempts = 0;
                    $login->token = bin2hex(random_bytes(32));
                    $login->save();
//                        Set cookies or sessions
                    if ($validate->Post("remember") == 1) {
                        Cookies::Create("token", $login->token)->Days(7)->Path("/")->Http(true)->Save();
                    } else {
                        Sessions::Create("token", $login->token);
                    }
//                        Redirect
                    if (isset($ref)) {
                        redirect($ref);
                    } else {
                        if ($login->is_admin == 1) {
                            redirect($url->make("auth.admin.home"));
                        } else {
                            redirect($url->make("account.home"));
                        }
                    }

                    } else {
                        $this->error = $validate->captchaerror;
                    }
                } else {
                    $this->error = "Password does not match";
                }
            } else {
                $this->error = "No user found";
            }
//            exit();
        }
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url, "error" => $this->error, "validate" => $validate, "username" => $this->username, "mode" => $mode, "value" => $this]);


    }

    public function logout(Url $url)
    {

        if (isset($_SESSION['token'])) {
            Sessions::Destroy("token");
        }

        if (isset($_COOKIE['token'])) {
            setcookie("token", '', time() - 3600, '/');
        }

//        Destroy Other Sessions and cookies
        Sessions::Destroy("tfa_approved");
        Sessions::Destroy("csrf_expire");
        redirect($url->make("login"));


    }

}