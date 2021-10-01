<?php


namespace App\Http\Controllers;

use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
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

    private $installed;

    private function setkey()
    { $key =  bin2hex(random_bytes(32));
    $_SESSION['key'] = $key;
        return $key;
    }

    private  function getkey($key,$url)
    {
        $installer = Installer::where("id",1)->where("key",$key)->get();
        if((empty($installer->first()->key)) || $installer->first()->key != $key)
        {
            redirect($url->make("installer.home"));
        }
        else
        {
            return $installer;
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

    public function profile($key, Url $url)
    {
        if (($this->getkey($key,$url)->count() == 1) && ($this->getkey($_SESSION['key'],$url)->count()==1)) {
            if ((!Capsule::schema()->hasTable("installers")) or (Installer::where("id", 1)->where("status", "<", 2)->get()->count() == 1)) {
                echo TemplateEngine::View("Pages.Backend.Installer.Profile", ["url" => $url, "key" => $key]);
            } else {
                echo "there is no setup";
            }
        }
        else
        {
            echo "No code";
        }

    }


    public function termsstore(Url $url, Validate $validate, Loader $loader,$key)
    {

        if ($validate->Post("key") == $key) {
            $accept = $validate->Post("accept");
            if ($accept != 1) {
                $error = "you must Accept the terms and conditions";
                $key = $this->generatekey();
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
        if (($validate->Post("key") == $key) && ($this->getkey($key,$url)->count()==1) && ($this->getkey($_SESSION['key'],$url)->count() == 1)) {
            $username = $validate->Required("username")->Post();
            $email = $validate->Required("email")->Post();
            $first_name = $validate->Required("first_name")->Post();
            $last_name = $validate->Required("last_name")->Post();
            $password = $validate->Required("password")->Post();

            if (User::where("id", 1)->get()->count() == 0) {
                $user = new User();
//        Default user id is 1
                $user->id = 1;
                $user->username = $username;
                $user->email = $email;
                $user->password = password_hash($password, PASSWORD_DEFAULT);
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
                $profile->first_name = $first_name;
                $profile->last_name = $last_name;
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

    public function settingsstore(Url $url, Validate $validate, $key)
    {
        echo "hello" . $key;
    }
}


