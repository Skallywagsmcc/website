<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Charter;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use Jenssegers\Blade\Blade;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{


    public  function index(Url $url)
    {
        $charters = Charter::all();
        echo TemplateEngine::View("Pages.Backend.Charters.index",["url"=>$url,"charters"=>$charters]);
    }


    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Charters.new",["url"=>$url]);
    }

    public  function store(Url $url, Validate $validate,Csrf $csrf)
    {
        if($csrf->Verify() == true) {
            $charter = new Charter();
            $charter->title = ucwords($validate->Required("title")->Post());
            $charter->slug = slug($charter->title);
            $charter->content = $validate->Required("content")->Post();
            $validate->Post("pinned") == 1 ? $charter->pinned = 1 : $charter->pinned = 0;
            $charter->pinned =
            $charter->save();

//        unpin every other charter
            if ($charter->pinned == 1) {
                $charters = Charter::where("id", "!=", $charter->id)->get();
                foreach ($charters as $charter) {
                    echo $charter->id . "<br>";
                    $charter->pinned = 0;
                    $charter->save();
                }
            }

            redirect($url->make("admin.charters.home"));
        }
    }

    public function edit($id,Url $url)
    {
        $id = base64_decode($id);
        $charter = Charter::Where("id",$id)->get();
        echo TemplateEngine::View("Pages.Backend.Charters.edit",["url"=>$url,"charter"=>$charter->first()]);
    }

    public function update(Url $url,Validate $validate,Csrf $csrf)
    {

        if($csrf->Verify() == true) {
            $charter = Charter::where("id",$validate->Post("id"))->get();
            if($charter->count() == 1) {
                $charter = $charter->first();
                $charter->title = ucwords($validate->Required("title")->Post());
                $charter->slug = slug($charter->title);
                $charter->content = $validate->Required("content")->Post();
                $validate->Post("pinned") == 1 ? $charter->pinned = 1 : $charter->pinned = 0;
                $charter->save();

//        unpin every other charter
                if ($charter->pinned == 1) {
                    $charters = Charter::where("id", "!=", $charter->id)->get();
                    foreach ($charters as $charter) {
                        echo $charter->id . "<br>";
                        $charter->pinned = 0;
                        $charter->save();
                    }
                }
            }

            redirect($url->make("admin.charters.home"));
        }

    }

    public function ShowDefault(Url $url)
    {
        $images = FeaturedImage::all();
        echo TemplateEngine::View("Pages.Backend.Charters.defaults");
    }

    public function StoreDefault(Validate $validate,Csrf $csrf,Validate $validate)
    {

        $id = $validate->Post("id");

        if (Auth::Auth()->RequirePassword($validate->Post("password")) == true) {
            if ($csrf->Verify() == true) {
                $charters = Charter::find($id);
                $charters->pinned = 1;
                $charters->save();
            }
        }
        else
        {
            echo TemplateEngine::View("Pages.Backend.Charteres.");
        }


    }


    public function delete(Url $url,$id)
    {
        $id = base64_decode($id);
        $charters = Charter::where("id",$id);
        if($charters->get()->first()->pinned == 1)
        {
            $charters = Charter::all();
            $error = "This Charter is set to default and cannot be deleted";
            echo TemplateEngine::View("Pages.Backend.Charters.index",["url"=>$url,"charters"=>$charters,"error"=>$error]);
        }
        else
        {
            $charters->delete();
            redirect($url->make("admin.charters.home"));
        }



    }

}