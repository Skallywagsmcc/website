<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
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

    public function __construct(Validate $validate)
    {
        $this->email = $validate->Post("email");
        $this->address = $validate->Post("address");
        $this->telephone = $validate->Post("telephone");
        $this->open_login = $validate->Post("open_login");
        $this->open_registration = $validate->Post("open_registration");
        $this->lock_submissions = $validate->Post("lock_submissions");
        $this->maintainence_status = $validate->Post("maintainence_status");
        $this->maintainence_message = $validate->Post("maintainence_status");
    }


    public function index(Url $url)
    {
        $settings = SiteSettings::find(1);
        echo TemplateEngine::View("Pages.Backend.AdminCp.settings", ["url" => $url, "settings" => $settings]);
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
                    if($validate->Allowed() == false)
                    {
                        $error = "Required fields are Missings";
                        $rmf = $validate->is_required;
                    }
                    else
                    {
                        $settings->save();
                        redirect($url->make("logout"));
                    }

                } else {
                    $settings->contact_email = $this->email;
                    $settings->contact_address = $this->address;
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
}