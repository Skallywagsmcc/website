<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use mbamber1986\Authclient\Auth;
use App\Http\Models\Image;
use App\Http\Models\User;
use App\Http\traits\FileManager;
use Migrations\Images;
use MiladRahimi\PhpRouter\Url;

class ProfilePictureController
{

    use FileManager;

    public  $entity_name;
    public $images;


    public function __construct(Validate $validate)
    {
        $this->entity_name = "page/profile";

//        if ($_SERVER['REQUEST_METHOD'] == "POST")
//        {
//
//        }
    }


    public function index(Url $url,Auth $auth)
    {

        $user = User::find($auth->id());
        $this->images =  Image::where("user_id",$user->id)->get();
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.Picture", ["user", $user, "url" => $url,"request"=>$this]);
    }


    public function store(Url $url, Validate $validate,Csrf $csrf,Auth $auth)
    {
//        Fixed as of $today
        $this->UploadDir();

        if($csrf->Verify()==true) {

            $user = User::find($auth->id());

            if($this->upload("upload") == true)
            {
                $image = new  Image();
                $image->user_id = $auth->id();
                $image->entity_name = $this->entity_name;
                $image->entity_id = $auth->id();
                $image->imagetype = "Profile Image";
                $image->name = $this->hashed_name;
                $image->size = $this->GetFile("size");
                $image->type = $this->GetFile("type");
                $image->save();
            }

                $profile = $user->Profile()->where("user_id", $auth->id())->get()->first();
                $profile->profile_pic = $image->id;
                $profile->save();
            redirect($url->make("account.home"));
        }
    }


}