<?php


namespace App\Http\Packages\Authentication;
use App\Http\Functions\TemplateEngine;
use App\Http\Models\TwoFactorCode as tfa;


use App\Http\Models\User;

class TwoFactorAuthentication
{

    public static function CreateCode($id)
    {
        $tfa = new tfa();
        $tfa->user_id = $id;
        $tfa->code = rand(000000,999999);
        $tfa->expire = time()+1800;
        $tfa->save();
    }

    public function RequestTfa($id)
    {
        $tfa = tfa::find($id)->get()->first();
        echo TemplateEngine::View("Pages.Authentication.TwoFactorAuth");
    }

  public function generate2fa($id)
  {

  }



}