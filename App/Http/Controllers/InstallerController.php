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
    public $open_reg;
    public $open_login;

    public function __construct(Validate $validate)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->username = $validate->Post("username");
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
            $this->confirm = $validate->Post("confirm");
            $this->first_name = $validate->Post("first_name");
            $this->last_name = $validate->Post("last_name");
            $this->open_reg = $validate->Post("open_reg");
            $this->open_login = $validate->Post("open_login");
        }
    }


    private function setkey()
    {
        $key = bin2hex(random_bytes(32));
        $_SESSION['key'] = $key;
        return $key;
    }

    public function index( Url $url)
    {

            if ((!Capsule::schema()->hasTable("installers")) or (Installer::where("id", 1)->where("status", "<", 2)->get()->count() == 1)) {
                echo TemplateEngine::View("Pages.Backend.Installer.index", ["url" => $url]);
            } else {
                echo "there is no setup";
            }

    }





    public function profilestore(Url $url, Validate $validate,Loader $loader)
    {
//        Create User Account


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

                    if ($site_settings->count() == 0) {
                        $site_settings = new SiteSettings();
                    } else {
                        $site_settings = $site_settings->first();
                    }
                    $site_settings->maintainence_status = 1;
                    $this->open_reg == 1 ? $site_settings->open_registration = 1 : $site_settings->open_registration = 0;
                    $this->open_login == 1 ? $site_settings->open_login = 1 : $site_settings->open_login = 0;
                    $site_settings->save();

                    $installer = Installer::find(1);
                    $installer->user_id = $user->id;
                    $installer->status = 2;
                    $installer->save();

//unset Sessin Key
                    redirect($url->make("login"));
            }

        echo TemplateEngine::View("Pages.Backend.Installer.Profile", ["url" => $url, "key" => $key, "error" => $error, "rmf" => $rmf, "post" => $this]);


    }
}



