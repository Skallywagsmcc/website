<?php


namespace App\Http\Controllers;

use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Installer;
use App\Http\Models\Profile;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use App\Libraries\MigrationManager\Loader;
use Illuminate\Database\Capsule\Manager as Capsule;
use MiladRahimi\PhpRouter\Url;

class InstallerController
{
    public $username;
    public $email;
    public $password;
    public $confirm;
    public $first_name;
    public $last_name;

    public function __construct(Validate $validate)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->username = $validate->Post("username");
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
            $this->confirm = $validate->Post("confirm");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
        }
    }

    public function index(Url $url)
    {
        $key = $this->setkey();

//        echo $this->getkey($key)
        $template = TemplateEngine::View("Pages.Backend.Installer.index", ["url" => $url, "key" => $key]);
        if (!Capsule::schema()->hasTable("installers")) {
            echo $template;
        } else {
            if (Installer::where("id", 1)->where("status", 2)->get()->count() == 1) {
                redirect($url->make("homepage"));
            } else {
                echo $template;
            }
        }


    }

    private function setkey()
    {
        $key = bin2hex(random_bytes(32));
        $_SESSION['key'] = $key;
        return $key;
    }

    public function profile($key, Url $url)
    {
        if (($this->getkey($key, $url)->count() == 1) && ($this->getkey($_SESSION['key'], $url)->count() == 1)) {
            if ((!Capsule::schema()->hasTable("installers")) or (Installer::where("id", 1)->where("status", "<", 2)->get()->count() == 1)) {
                echo TemplateEngine::View("Pages.Backend.Installer.Profile", ["url" => $url, "key" => $key]);
            } else {
                echo "there is no setup";
            }
        } else {
            echo "No code";
        }

    }

    private function getkey($key, $url)
    {
        $installer = Installer::where("id", 1)->where("key", $key)->get();
        if ((empty($installer->first()->key)) || $installer->first()->key != $key) {
            redirect($url->make("installer.home"));
        } else {
            return $installer;
        }

    }

    public function termsstore(Url $url, Validate $validate, Loader $loader, $key)
    {

        if ($validate->Post("key") == $key) {
            $accept = $validate->Post("accept");
            if ($accept != 1) {
                $error = "you must Accept the terms and conditions";
                $key = $this->setkey();
                echo TemplateEngine::View("Pages.Backend.Installer.index", ["url" => $url, "key" => $key, "error" => $error]);
            } else {
                $loader->install();
                $installer = Installer::where("id", 1)->get();
                if ($installer->count() == 1) {
                    $installer = $installer->first();
                } else {
                    $installer = new Installer();
                }
                $installer->id = 1;
                $installer->status = 1; //1 = pending 2 complete
                $installer->agreed_terms = 1;
                $installer->key = $key;
                $installer->save();

                redirect($url->make("installer.profile.home", ["key" => $validate->Post("key")]));
            }
        } else {
            exit("invalid key");
        }
    }

    public function profilestore(Url $url, Validate $validate, $key)
    {
//        Create User Account


        $validate->AddRequired(["username", "email", "password", "confirm", "first_name", "last_name"]);

        if ($validate->Allowed() == false) {
            $error = "Missing fields";
            $rmf = str_replace("_", " ", $validate->is_required);
        } elseif ($validate->Post("password") != $validate->Post("confirm")) {
            $error = "Passwords do not match";
        } else
            if (empty($this->password) || empty($this->confirm) || $validate->HasStrongPassword($validate->Post("password")) == false) {
                $error = "Password Must match our strong Password Policy";
                $rmf = ["Must not hold an empty value", "Minimum of 8 letters", "Have one Upper case Letter", "Have At least one Lower case letter", "At least one number"];
            } else {
                if (($validate->Post("key") == $key) && ($this->getkey($key, $url)->count() == 1) && ($this->getkey($_SESSION['key'], $url)->count() == 1)) {

                    if (User::where("id", 1)->get()->count() == 0) {
                        $user = new User();
//        Default user id is 1
                        $user->id = 1;
                        $user->username = $this->username;
                        $user->email = $this->email;
                        $user->password = password_hash($this->password, PASSWORD_DEFAULT);
                        $user->is_admin = 1;
                        $_SESSION['user_id'] = $user->id;
                        $user->save();
                    }

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

                    if ($site_settings->count() == 0) {
                        $site_settings = new SiteSettings();
                    } else {
                        $site_settings = $site_settings->first();
                    }
                    $site_settings->maintainence_status = 1;
                    $validate->Post("open_reg") == 1 ? $site_settings->open_registration = 1 : $site_settings->open_registration = 0;
                    $validate->Post("open_login") == 1 ? $site_settings->open_login = 1 : $site_settings->open_login = 0;
                    $site_settings->save();

                    $installer = Installer::find(1);
                    $installer->user_id = $user->id;
                    $installer->key = "";
                    $installer->status = 2;
                    $installer->save();

//unset Sessin Key
                    unset($_SESSION['key']);
                    redirect($url->make("login"));
                } else {
                    exit("<h2>Invalid Request</h2>");
                }
            }

        echo TemplateEngine::View("Pages.Backend.Installer.Profile", ["url" => $url, "key" => $key, "error" => $error, "rmf" => $rmf, "post" => $this]);


    }

    public function settingsstore(Url $url, Validate $validate, $key)
    {
        echo "hello" . $key;
    }
}



