<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use App\Http\traits\Activity_log;
use App\Http\traits\FileManager;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class ProfilePictureController
{

    use FileManager;
    use \App\Http\traits\Csrf;

    public $entity_name;
    public $images;
    public $error;
    public $user;
    public $links;
    public $ppic;

    use Activity_log;

    public function __construct(Validate $validate)
    {
        $this->entity_name = "page/gallery";

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $this->ppic = $validate->Post("ppic");
        }
    }


    public function index(Url $url, Auth $auth)
    {

        $this->user = User::find($auth->id());
        $this->images = Image::where("user_id", $this->user->id)->where("entity_name", $this->entity_name);
        $pagination = new LaravelPaginator("5","Page");
        $this->images = $pagination->paginate($this->images);
        $this->links = $pagination->page_links();
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.Picture", ["url" => $url, "request" => $this]);
    }


    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
//        Fixed as of $today
        $this->UploadDir();

        if ($csrf->Verify() == true) {
            if($this->EmptyFIle("upload") == true)
            {
                $this->error = "Image Upload field cannot be left empty";
            }
            elseif($this->IsSupported("upload",["png","jpeg","jpg"]) == false)
            {
                $this->error = "Sorry please upload using the correct format " . implode(", ", $this->format);
            }
            elseif($this->Filesize("upload") == false)
            {
                $this->error = "File upload size  for cover image exceeds the value of " . $this->HRFS($this->MFS);
            }
            else
            {
                $user = User::find($auth->id());

                if ($this->upload("upload") == true) {
                    $image = new  Image();
                    $image->user_id = $auth->id();
                    $image->entity_name = $this->entity_name;
                    $image->entity_id = 0;
                    $image->imagetype = "Profile Image";
                    $image->name = $this->hashed_name;
                    $image->size = $this->GetFile("size");
                    $image->type = $this->GetFile("type");
                    $image->save();
                }

                if($this->ppic == 1) {
                    $profile = $user->Profile()->where("user_id", $auth->id())->get()->first();
                    $profile->profile_pic = $image->id;
                    $profile->save();
                        $this->addurl("http://" . $_SERVER["HTTP_HOST"] . "/img/uploads/" . $image->name . "")->newactivity("profile_pic", "upload");
                }
                else
                {
                    $this->newactivity("image","upload","http://".$_SERVER["HTTP_HOST"]."/img/uploads/".$image->name."");
                }
micra
                redirect($url->make("account.picture.home"));
            }
        }
        else
        {
            $this->error = $this->CsrfError();
        }
        $this->images = Image::where("user_id", $this->user->id)->where("entity_name", $this->entity_name);
        $pagination = new LaravelPaginator("5","Page");
        $this->images = $pagination->paginate($this->images);
        $this->links = $pagination->page_links();
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.Picture", ["url" => $url, "request" => $this]);
    }

    public function SetProfileImage(Url $url,$id, Auth $auth)
    {
        $id = base64_decode($id);
        $image = Image::where("id", $id)->where("user_id",$auth->id())->get();
        if ($image->count() == 1) {
            $image = $image->first();
            $profile = Profile::where("id", $auth->id())->get();
            $profile->count() ==1 ? $profile = $profile->first() : false;
            $profile->profile_pic = $image->id;
            $profile->save();
            if($profile->profile_pic != $image->id) {
                $this->addurl("http://" . $_SERVER["HTTP_HOST"] . "/img/uploads/" . $image->name . "")->newactivity("profile_pic", "set");
            }
            redirect($url->make("account.picture.home"));
        }
    }


    public function deleteImage(Url $url,$id, Auth $auth)
    {
        $id = base64_decode($id);
        $this->image = Image::where("entity_name",$this->entity_name)->where("id", $id)->where("user_id",$auth->id());
        if ($this->image->count() == 1) {
            $profile = Profile::find($auth->id());
            if($profile->first()->profile_pic == $this->image->get()->first()->id)
            {
                $profile->profile_pic = null;
                $profile->save();
            }

            if(file_exists(UPLOAD_DIR."/".$this->image->get()->first()->name)) {
                $this->rmfile($this->image->get()->first()->name);
            }
            $this->image->delete();
            $this->newactivity("image","delete");
            redirect($url->make("account.picture.home"));
        }
        else
        {
            $this->images = Image::where("user_id", $this->user->id)->where("entity_name", $this->entity_name);
            $pagination = new LaravelPaginator("5","Page");
            $this->images = $pagination->paginate($this->images);
            $this->links = $pagination->page_links();
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.Picture", ["url" => $url, "request" => $this]);
        }
    }


}