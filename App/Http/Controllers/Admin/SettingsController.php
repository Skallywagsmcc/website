<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Libraries\MigrationManager\Loader;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\SiteSettings;
use App\Http\Models\Article;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class SettingsController
{

    public $maintainence_status;
    public $address;
    public $email;
    public $telephone;
    public $open_login;
    public $open_registration;
    public $lock_submissions;
    public $lock_message;
    public $name;
    public $street;
    public $city;
    public $county;
    public $postcode;
    private $password;

    public function __construct(Validate $validate)
    {
        $this->email = $validate->Post("email");
        $this->address = explode(",", SiteSettings::where("id", 1)->get()->first()->contact_address);
        $this->telephone = $validate->Post("telephone");
        $this->open_login = $validate->Post("open_login");
        $this->open_registration = $validate->Post("open_registration");
        $this->lock_submissions = $validate->Post("lock_submissions");
        $this->maintainence_status = $validate->Post("maintainence_status");
        $this->maintainence_message = $validate->Post("maintainence_status");
        $this->password = $validate->Post("password");

        $this->name = $validate->Post("name");
        $this->street = $validate->Post("street");
        $this->city = $validate->Post("city");
        $this->county = $validate->Post("county");
        $this->postcode = $validate->Post("postcode");
    }


    public function index(Url $url)
    {
        $settings = SiteSettings::find(1);
        print_r($this->address);
        echo TemplateEngine::View("Pages.Backend.AdminCp.settings", ["url" => $url, "settings" => $settings, "post" => $this]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            $user = User::where("id", $auth->id())->where("is_admin", 1)->get();


            $settings = SiteSettings::where("id", 1)->get();
            if ($settings->count() == 1) {
                $settings = $settings->first();
                if ($this->lock_submissions == 1) {
                    $required = ["lock_message"];
                    $settings->lock_message = $this->lock_message;
                    if ($validate->Allowed() == false) {
                        $error = "Required fields are Missings";
                        $rmf = $validate->is_required;
                    } else {
                        $settings->save();
                        redirect($url->make("logout"));
                    }

                } else {
                    $settings->contact_email = $this->email;
                    $settings->contact_address = trim($this->name) . ",";
                    $settings->contact_address .= trim($this->street) . ",";
                    $settings->contact_address .= trim($this->city) . ",";
                    $settings->contact_address .= trim($this->county) . ",";
                    $settings->contact_address .= trim($this->postcode);
                    $settings->contact_telephone = $this->telephone;
                    $settings->maintainence_status = $this->maintainence_status;
                    $settings->open_login = $this->open_login;
                    $settings->open_registration = $this->open_registration;
                    $settings->lock_submissions = $this->lock_submissions;
                    $settings->save();
                    redirect($url->make("auth.admin.home"));
                }
            }
        }


        echo TemplateEngine::View("Pages.Backend.AdminCp.settings", ["url" => $url, "error" => $error, "user" => $user->first(), "settings" => $settings, "post" => $this]);
    }


//TODO : Add Edit method

//ToDO : Add Update method

//Todo Implement Database Reinstall Method index and store


    public function dbinstall_index(Url $url)
    {
//        Password for the user will be required before installing the database
        echo TemplateEngine::View("Pages.Backend.AdminCp.Settings.Database.index", ["url" => $url]);
    }

    public function dbinstall_store(Csrf $csrf, Validate $validate, Url $url, Loader $loader)
    {
        if ($validate->HasStrongPassword($this->password) == false) {
            $error = "Password Cannot be empty";
        } else {

            $loader->drop();
            $loader->install();
            redirect($url->make("auth.admin.settings.home"));

        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Settings.Database.index", ["url" => $url, "error" => $error]);
    }


}