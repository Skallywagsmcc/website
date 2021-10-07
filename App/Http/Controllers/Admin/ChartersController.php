<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use mbamber1986\Authclient\Auth;
use App\Http\Models\Charter;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use Jenssegers\Blade\Blade;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{


    public function index(Url $url)
    {
        $charters = Charter::all();
        echo TemplateEngine::View("Pages.Backend.Charters.index", ["url" => $url, "charters" => $charters]);
    }


    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Charters.new", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth, Filemanager $filemanager)
    {
        if ($csrf->Verify() == true) {
            $charter = new Charter();

            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
            if ($filemanager->success == true) {
                $thumb = new Image();
                $thumb->user_id = $auth->i$article->entry_name = "Articles";d();
                $thumb->entry_name = "Images";
                $thumb->nvtug = 1;
                $thumb->title = "Event Thumbnail : " . str_replace(" ", "-", $validate->Required("title")->Post());
                $thumb->name = $filemanager->GetUniqueName();
                $thumb->size = $filemanager->GetFile("size");
                $thumb->type = $filemanager->GetFile("type");
                $thumb->description = $validate->Post("content");
                $thumb->save();
            }

            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/covers/")->upload("cover");
            if ($filemanager->success == true) {
                $cover = new Image();
                $cover->user_id = $auth->id();
                $cover->entry_name = "Images";
                $cover->nvtug = 1;
                $cover->title = "Event Thumnail : " . str_replace(" ", "-", $validate->Required("title")->Post());
                $cover->name = $filemanager->GetUniqueName();
                $cover->size = $filemanager->GetFile("size");
                $cover->type = $filemanager->GetFile("type");
                $cover->description = $validate->Post("content");
                $cover->save();
            }


            $charter->user_id = $auth->id();
            $charter->entry_name = "Charters";
            $charter->thumbnail = $thumb->id;
            $charter->cover = $cover->id;
            $charter->title = ucwords($validate->Required("title")->Post());
            $charter->slug = slug($charter->title);
            $charter->content = $validate->Required("content")->Post();
            $charter->url = $validate->Post("url");
            $charter->save();

            redirect($url->make("auth.admin.charters.home"));
        }
    }

    public function edit($id, Url $url)
    {
        $id = base64_decode($id);
        $charter = Charter::Where("id", $id)->get();
        echo TemplateEngine::View("Pages.Backend.Charters.edit", ["url" => $url, "charter" => $charter->first()]);
    }

    public function update(Url $url, Validate $validate, Csrf $csrf, Filemanager $filemanager, Auth $auth)
    {

        if ($csrf->Verify() == true) {
            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");

            if ($filemanager->success == true) {
                $thumb = new Image();
                $thumb->user_id = $auth->id();
                $thumb->entry_name = "Images";
                $thumb->nvtug = 1;
                $thumb->title = "Event Thumnail : " . str_replace(" ", "-", $validate->Required("title")->Post());
                $thumb->name = $filemanager->GetUniqueName();
                $thumb->size = $filemanager->GetFile("size");
                $thumb->type = $filemanager->GetFile("type");
                $thumb->description = $validate->Post("content");
                $thumb->save();
            }


            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/covers/")->upload("cover");
            if ($filemanager->success == true) {
                $cover = new Image();
                $cover->user_id = $auth->id();
                $cover->entry_name = "Images";
                $cover->nvtug = 1;
                $cover->title = "Event Thumnail : " . str_replace(" ", "-", $validate->Required("title")->Post());
                $cover->name = $filemanager->GetUniqueName();
                $cover->size = $filemanager->GetFile("size");
                $cover->type = $filemanager->GetFile("type");
                $cover->description = $validate->Post("content");
                $cover->save();
            }



            $charter = Charter::where("id", $validate->Post("id"))->get();
            if ($charter->count() == 1) {
                $charter = $charter->first();
                $charter->title = ucwords($validate->Required("title")->Post());

                if($charter->image()->count() == 1)
                {
                    Image::destroy($charter->image->id);
//            Unlink the file
                    unlink(UPLOAD_DIR . $charter->image->name);
                }

                if($charter->CoverImage()->count() == 1)
                {
                    Image::destroy($charter->CoverImage->id);
//            Unlink the file
                    unlink(UPLOAD_DIR."/covers/" . $charter->CoverImage->name);
                }

                $charter->entry_name = "Charters";
                $charter->thumbnail = $thumb->id;
                $charter->cover = $cover->id;
                $charter->slug = slug($charter->title);
                $charter->content = $validate->Required("content")->Post();
                $charter->url = $validate->Post("url");
                $charter->save();

            }
        }

        redirect($url->make("auth.admin.charters.home"));

    }

    public function ShowDefault(Url $url)
    {
        $images = FeaturedImage::all();
        echo TemplateEngine::View("Pages.Backend.Charters.defaults");
    }

    public function SetDefault(Validate $validate, Url $url, Csrf $csrf)
    {
        $id = $validate->Post("id");
        $charters = Charter::where("id", $id)->get();

        if ($charters->count() == 1) {
            $unsetDefault = Charter::where("id", "!=", "$id")->update(["default" => 0]);
            $charters = $charters->first();
            $charters->default = 1;
            $charters->save();
            redirect($url->make("auth.admin.charters.home"));
        }
    }


    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        $charters = Charter::where("id", $id);
        if ($charters->get()->first()->default == 1) {
            $charters = Charter::all();
            $error = "This Charter is set to default and cannot be deleted";
            echo TemplateEngine::View("Pages.Backend.Charters.index", ["url" => $url, "charters" => $charters, "error" => $error]);
        } else {
            $charters->delete();
            redirect($url->make("auth.admin.charters.home"));
        }


    }

}