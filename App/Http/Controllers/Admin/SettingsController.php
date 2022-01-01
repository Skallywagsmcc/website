<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Address;
use App\Libraries\MigrationManager\Loader;
use Laminas\Diactoros\ServerRequest;
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
    private $drop;
    public $settings;

    public function __construct(Validate $validate)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->email = $validate->Post("email");
            $this->address = explode(",", SiteSettings::where("id", 1)->get()->first()->contact_address);
            $this->telephone = $validate->Post("telephone");
            $this->open_login = $validate->Post("open_login");
            $this->open_registration = $validate->Post("open_registration");
            $this->lock_submissions = $validate->Post("lock_submissions");
            $this->maintainence_status = $validate->Post("maintainence_status");
            $this->maintainence_message = $validate->Post("maintainence_status");
            $this->password = $validate->Post("password");
            $this->drop = $validate->Post("drop");

            $this->name = $validate->Post("name");
            $this->street = $validate->Post("street");
            $this->city = $validate->Post("city");
            $this->county = $validate->Post("county");
            $this->postcode = $validate->Post("postcode");
            $this->migration = $validate->Post("migration");
        }
    }


    public function index(Url $url)
    {
        $settings = SiteSettings::find(1);
        $addresses = Address::where("contactus",1)->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.settings", ["url" => $url, "settings" => $settings,"addresses"=>$addresses,"post" => $this]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
//        Variables

        if ($csrf->Verify() == true) {

            $this->settings = SiteSettings::where("id", 1)->get();
            $addresses = Address::where("contactus",1)->get();
            if ($this->settings->count() == 1) {
                $this->settings = $this->settings->first();
                    $this->settings->contact_email = $this->email;
                    $this->settings->maintainence_status = $this->maintainence_status;
                    $this->settings->open_login = $this->open_login;
                    $this->settings->open_registration = $this->open_registration;
                    $this->settings->lock_submissions = $this->lock_submissions;
                    $this->settings->save();
                    redirect($url->make("auth.admin.home"));
            }
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.settings", ["url" => $url, "error" => $error,"addresses"=>$addresses,"post" => $this]);
    }



    public function dbinstall_index(Url $url,ServerRequest $request)
    {

        echo TemplateEngine::View("Pages.Backend.AdminCp.Settings.Database.index", ["url" => $url]);
    }

    public function dbinstall_store(Csrf $csrf,Auth $auth, Validate $validate, Url $url, Loader $loader)
    {

        if($csrf->Verify() == true) {
            if ($auth->RequirePassword($this->password) == false) {
                $error = "Password Cannot be empty";
            } else {
                $loader->install();
                redirect($url->make("auth.admin.settings.home"));
            }
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Settings.Database.index", ["url" => $url, "error" => $error]);
    }


}