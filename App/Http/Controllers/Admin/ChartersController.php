<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Charter;
use App\Http\Models\Image;
use App\Http\traits\ErrorHandling;
use App\Http\traits\Resources;
use mbamber1986\Authclient\Auth;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{

    public $charter;

    public $entity_name;
    public $error;
    public $required;

//    form data

    public $id;
    public $title;
    public $content;
    public $url;


//Add traits

    use Resources;
    use \App\Http\traits\FileManager;
    use ErrorHandling;

    public function __construct(Validate $validate)
    {
        $this->entity_name = "page/charter";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->id = $validate->Post("id");
            $this->title = $validate->Post("title");
            $this->content = $validate->Post("content");
            $this->url = $validate->Post("url");

        }
    }

    public function index(Url $url)
    {
        $charters = Charter::all();
        echo TemplateEngine::View("Pages.Backend.Charters.index", ["url" => $url, "charters" => $charters, "request" => $this]);
    }


    public function create(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.Charters.new", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth, Filemanager $filemanager)
    {

        $this->UploadDir();
        if ($csrf->Verify() == true) {
            if ($validate->Allowed() == false) {
                $this->error = "Missing fields";
                $this->required = $validate->is_required;
            }
// elseif (($this->fileerror("thumb") == false) or ($this->fileerror("cover") == false)) {
//                $this->error = "A Thumbnail  or cover image cannot be left empty";
//            }elseif (($this->fileerror("thumb") == false)) {
//                $this->error = "A Thumbnail  or cover image cannot be left empty";
//            }
else {
//                Upload images
                $id = Charter::all()->last()->id + 1;

                $this->processUpload("thumb");
                //        Error check
                if ($this->upload() == true) {
                    $thumb = new Image();
                    $thumb->user_id = $auth->id();
                    $thumb->entity_name = $this->entity_name;
                    $thumb->entity_id = $id;
                    $thumb->imagetype = "thumbnail";
                    $thumb->name = $this->hashed_name;
                    $thumb->type = $this->GetFile("type");
                    $thumb->size = $this->GetFile("size");
                    $thumb->save();
                    echo "Upload Complete";
                    // We will continue to the next section
                } else {
                    $this->error = "File Upload failed";
                }
//                fetch the last image requests made so they can be deleted in case charter doesnt save


//                Save the charter
                if ($this->success == true) {
                    $charter = new Charter();
                    $charter->thumbnail = $thumb->id;
                    $charter->cover = $cover->id;
                    $charter->title = ucwords($this->title);
                    $charter->slug = slug($charter->title);
                    $charter->content = $this->content;
                    $charter->save();
                    redirect($url->make("auth.admin.charters.edit",["id"=>base64_encode($id)]));
                } else {
                    $this->error = "Upload failed";
                }

            }
            $validate->AddRequired(["title", "content"]);
        } else {
            $this->error = "Csrf token is invalid";
        }

        echo TemplateEngine::View("Pages.Backend.Charters.new", ["url" => $url, "request" => $this]);
    }

    public function edit($id, Url $url)
    {
        $this->id = base64_decode($id);
        $this->charter = Charter::Where("id", $this->id)->get();
        if($this->charter->count()==1)
        {
            $this->charter = $this->charter->first();
        }
        echo TemplateEngine::View("Pages.Backend.Charters.edit", ["url" => $url,"request"=>$this]);
    }

    public function update(Url $url, Validate $validate, Csrf $csrf, Filemanager $filemanager, Auth $auth)
    {
        if ($csrf->Verify() == true) {

            $charter = Charter::where("id", $this->id)->get();
            if ($charter->count() == 1) {
                $charter = $charter->first();
                $charter->title = ucwords($this->title);

//                if ($charter->image()->count() == 1) {
//                    Image::destroy($charter->image->id);
////            Unlink the file
//                    unlink(UPLOAD_DIR . $charter->image->name);
//                }
//
//                if ($charter->CoverImage()->count() == 1) {
//                    Image::destroy($charter->CoverImage->id);
////            Unlink the file
//                    unlink(UPLOAD_DIR . "/covers/" . $charter->CoverImage->name);
//                }

                $charter->entry_name = "Charters";
//                $charter->thumbnail = $thumb->id;
//                $charter->cover = $cover->id;
                $charter->slug = slug($charter->title);
                $charter->content = $this->content;
                $charter->save();

            }
        }

        redirect($url->make("auth.admin.charters.edit",["id"=>base64_encode($this->id)]));

    }

    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        $charters = Charter::where("id", $id);

        if ($charters->count() == 1) {
            $charter = $charters->get()->first();
            Image::where("entity_name", $this->entity_name)->where("entity_id", $charter->id)->delete();
            $charters->delete();
        }
    }




    public function edit_thumb(){}
    public function update_thumb(){}
    public function edit_cover(){}
    public function update_cover(){}

}