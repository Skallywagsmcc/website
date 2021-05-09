<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\PasswordManager;
use App\Http\Models\PasswordRequest;
use MiladRahimi\PhpRouter\Url;

class PasswordController
{

    public function index(Url $url, PasswordManager $passwordManager)
    {
        echo TemplateEngine::View("Pages.Frontend.PasswordReset.index", ["url" => $url]);
    }

    public function request(Url $url, Validate $validate, PasswordManager $passwordManager)
    {
        $passwordManager->SendRequest($validate);
        if ($passwordManager->Approved == true) {
            echo "Reset password";
        }
    }


    public function retrieve($id, $hex, Url $url)
    {
        $password = new PasswordManager();
        $password->RetrieveRequest($id, $hex);
        if ($password->Approved == true) {
            echo TemplateEngine::View("Pages.Frontend.PasswordReset.NewPassword", ["url" => $url, "id" => $id, "hex" => $hex]);
        } else {
        }
    }


    public function store(Url $url, Validate $validate)
    {

        $id = $validate->Post("id");
        $password = PasswordRequest::where("id", $id);
        if ($password->get()->count() == 1) {
            if (time() < $password->get()->first()->expires) {
                $user = $password->get()->first()->user;
                $user->password = password_hash($validate->Post("password"), PASSWORD_DEFAULT);
                $user->save();
                $password->delete();
                redirect($url->make("login"));
            } else {
                exit("This request has expired");
            }
        }
    }

    /*Notes

    this section is nearly done i just need to set up an emailing system that will send the link and hex to the  users registered email address
    should be finished by 20/04/2021
    */
}