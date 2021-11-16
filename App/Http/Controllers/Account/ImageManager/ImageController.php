<?php

namespace App\Http\Controllers\Account\ImageManager;

use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class ImageController
{

    public static $uploaderror;
    public $title;
    public $description;
    public $ppic;

    public function __construct(Validate $validate)
    {
        $this->title = $validate->Post("title");
        $this->description = $validate->Post("description");
        $this->ppic = $validate->Post("ppic");
    }

    public function index(Url $url, Auth $auth)
    {
        $images = Image::where("user_id", $auth->id())->where("nvtug", "0");
        $pagiantion = new LaravelPaginator("6", "p");
        $images = $pagiantion->paginate($images);
        $links = $pagiantion->page_links();
        echo TemplateEngine::View("Pages.Backend.UserCp.ImageManager.list", ["url" => $url, "auth" => $auth, "images" => $images, "links" => $links]);
    }

    public function show($id)
    {

    }

    public function create(Url $url, Auth $auth)
    {
        echo TemplateEngine::View("Pages.Backend.UserCp.ImageManager.add", ["url" => $url, "auth" => $auth, "images" => $images]);
    }

    public function store(Url $url, Filemanager $filemanager, Auth $auth, Csrf $csrf, Validate $validate)
    {

        if ($csrf->Verify() == true) {

            $validate->AddRequired(["title", "description"]);
            $filemanager->AddDir("img/uploads/")->validformat(["png", "jpg"])->upload("upload");
            if ($validate->Allowed() == false) {
                $error = "Required Fields are Missing";
                $required = $validate->is_required;
            }
            elseif($filemanager->GetFile("error") == 4)
            {
                $error = "No Image Uploaded";
            }
            else {
                if ($filemanager->success == true) {
                    $image = new Image();
                    $image->user_id = $auth->id();
                    $image->entry_name = "Images";
                    $image->title = $this->title;
                    $image->name = $filemanager->GetUniqueName();
                    $image->size = $filemanager->GetFile("size");
                    $image->type = $filemanager->GetFile("type");
                    $image->description = $this->description;
                    $image->save();
                    if ($this->ppic== 1) {
                        $profile = Profile::where("user_id", $auth->id())->get()->first();
                        $profile->profile_pic = $image->id;
                        $profile->save();
                    }
                    redirect($url->make("images.gallery.home"));
                }
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.ImageManager.add", ["url" => $url, "auth" => $auth, "validate" => $validate, "error" => $error, "required" => $required]);
        }
    }


    public function edit($id, Url $url, Auth $auth)
    {
        $images = Image::where("user_id", $auth->id())->where("id", $id)->get();
        if ($images->count() == 1) {
            $image = $images->first();
        }
        echo TemplateEngine::View("Pages.Backend.UserCp.ImageManager.manage", ["url" => $url, "auth" => $auth, "image" => $image]);
    }

    public function update($id,Url $url, Auth $auth, Csrf $csrf, Validate $validate)
    {
        $profile = Profile::where("user_id",$auth->id())->get()->first();
        if ($csrf->Verify() == true) {
            if($this->ppic == 1)
            {
                $profile->profile_pic = $id;
                $profile->save();
            }
            redirect($url->make("images.gallery.home"));
        } else {
            echo "Invalid token";
        }


//        Setup  the image request

//        Setup make profile photo

//        Save
    }

    public function delete($id, Auth $auth, Url $url)
    {
//        Name of
        $id = base64_decode($id);
        $profile = Profile::where("user_id", $auth->id())->get()->first();
        $image = Image::where("id", $id);
        $featured = FeaturedImage::where("image_id", $image->get()->first()->id)->get();

        $dir = UPLOAD_DIR;
//        check for the directory

        if (is_dir($dir)) {
            if (file_exists($dir . "/" . $image->get()->first()->name)) {
//                check if the profile_pic id and the image id match
                if ($image->first()->id == $profile->profile_pic) {
                    $profile->profile_pic = null;
                    $profile->save();
                }
//                delete from the file structure
                unlink($dir . "/" . $image->get()->first()->name);
//                    delete the image from the database
                $image->delete();
//Delete from featured Requests database.
                if ($featured->count() == 1) {
                    $featured->first()->destroy($featured->id);
                }
                redirect($url->make("images.gallery.home"));
            }
        } else {
            echo "No directory";
        }
    }

}