<?php


namespace App\Http\Controllers;

use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\Installer;
use App\Http\Models\Profile;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use App\Libraries\MigrationManager\Loader;
use Illuminate\Database\Capsule\Manager as Capsule;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class InstallerController
{
    public $username;
    public $email;
    public $password;
    public $confirm;
    public $first_name;
    public $last_name;
    public $open_reg;
    public $open_login;
    public $status;
    public $token_verfied;
    public $post_token;
    public $request;

    public function __construct(Validate $validate)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->username = $validate->Post("username");
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
            $this->confirm = $validate->Post("confirm");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->open_reg = $validate->Post("open_reg");
            $this->open_login = $validate->Post("open_login");
            $this->post_token = $validate->Post("post_token");
            $this->status = false;
        }
    }


    public function index(Url $url,)
    {
        if (isset($_SESSION['token'])) {
            $this->verifykey($_SESSION['token']);
            if($this->token_verfied == true)
            {
                if (Capsule::schema()->hasTable("installers")) {
                    if (Installer::where("status", 1)->count() ==1) {
                        $this->status = true;
                    } else {
                        $this->status = false;
                    }
                } else {
                    $this->status = false;
                }

                if ($this->status == false) {
                    echo TemplateEngine::View("Pages.Backend.Installer.index", ["url" => $url]);
                } else {
                    redirect($url->make("homepage"));
                }
            }
            else
            {
            echo "failed";
            }
        } else {
            redirect($url->make("installer.generate.key"));
        }


    }

    public function generatekey(Url $url, Validate $validate)
    {
        $key = $validate->RequestHexKey();
        $_SESSION['token'] = $key;
        redirect($url->make("installer.home"));
    }


    public function verifykey($token)
    {
        if ($_SESSION['token'] == $token) {
            $this->token_verfied = true;
        } else {
            $this->token_verfied = false;
        }
    }

    public function profilestore(Url $url, Validate $validate, Loader $loader)
    {
//        Create User Account
        if (Capsule::schema()->hasTable("installers")) {
            if (Installer::where("status", 1)) {
                $this->status = true;
            } else {
                $this->status = false;
            }
        } else {
            $this->status = false;
        }

        if ($this->status == false) {
            $validate->AddRequired(["username", "email", "password", "confirm", "first_name", "last_name"]);

            if ($validate->Allowed() == false) {
                $error = "Missing fields";
                $rmf = str_replace("_", " ", $validate->is_required);
            } elseif ($this->password != $this->confirm) {
                $error = "Passwords do not match";
            } else
                if (empty($this->password) || empty($this->confirm) || $validate->HasStrongPassword($this->password) == false) {
                    $error = "Password Must match our strong Password Policy";
                    $rmf = ["Must not hold an empty value", "Minimum of 8 letters", "Have one Upper case Letter", "Have At least one Lower case letter", "At least one number"];
                } else {

                    $loader->install();


                    $user = new User();
//        Default user id is 1
                    $user->id = 1;
                    $user->username = $this->username;
                    $user->email = $this->email;
                    $user->password = password_hash($this->password, PASSWORD_DEFAULT);
                    $user->is_admin = 1;
                    $_SESSION['user_id'] = $user->id;
                    $user->save();

                    if (UserSettings::where("user_id", 1)->get()->count() == 0) {
                        $user_settings = new UserSettings();
                        $user_settings->user_id = $user->id;
                        $user_settings->save();
                    }


//        Create profile
                    if (Profile::where("user_id", 1)->get()->count() == 0) {
                        $profile = new Profile();
                        $profile->user_id = $user->id;
                        $profile->first_name = $this->first_name;
                        $profile->last_name = $this->last_name;
                        $profile->is_crew = 1;
                        $profile->profile_pic = null;
                        $profile->save();
                    }
                    //        Site Settings
                    $site_settings = SiteSettings::where("id", 1)->get();
                    $site_settings = new SiteSettings();
                    $site_settings->maintainence_status = 1;
                    $this->open_reg == 1 ? $site_settings->open_registration = 1 : $site_settings->open_registration = 0;
                    $this->open_login == 1 ? $site_settings->open_login = 1 : $site_settings->open_login = 0;
                    $site_settings->save();

                    $installer = new Installer();
                    $installer->user_id = $user->id;
                    $installer->status = 1;
                    $installer->save();

//unset Sessin Key
                    unset($_SESSION['token']);
                    redirect($url->make("login"));
                }
        } else {
            redirect($url->make("homepage"));
        }

        echo TemplateEngine::View("Pages.Backend.Installer.index", ["url" => $url, "error" => $error, "rmf" => $rmf, "post" => $this]);
    }

    private function setkey()
    {
        $key = bin2hex(random_bytes(32));
        $_SESSION['key'] = $key;
        return $key;
    }
}



