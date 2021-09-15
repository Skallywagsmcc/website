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
            $charter->uid = $validate->uid();
            $charter->title = ucwords($validate->Required("title")->Post());
            $charter->slug = slug($charter->title);
            $charter->content = $validate->Required("content")->Post();
            $charter->url = $validate->Post("url");
            $charter->save();

            redirect($url->make("auth.admin.charters.home"));
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
                $charter->uid = $validate->uid();
                $charter->slug = slug($charter->title);
                $charter->content = $validate->Required("content")->Post();
                $charter->url = $validate->Post("url");
              $charter->save();

            }

            redirect($url->make("auth.admin.charters.home"));
        }

    }

    public function ShowDefault(Url $url)
    {
        $images = FeaturedImage::all();
        echo TemplateEngine::View("Pages.Backend.Charters.defaults");
    }

    public function SetDefault(Validate $validate,Url $url,Csrf $csrf)
    {
        $id = $validate->Post("id");
        $charters = Charter::where("id",$id)->get();

        if($charters->count() == 1)
        {
            $unsetDefault = Charter::where("id","!=","$id")->update(["default"=>0]);
            $charters = $charters->first();
            $charters->default = 1;
            $charters->save();
            redirect($url->make("auth.admin.charters.home"));
        }


    }


    public function delete(Url $url,$id)
    {
        $id = base64_decode($id);
        $charters = Charter::where("id",$id);
        if($charters->get()->first()->default == 1)
        {
            $charters = Charter::all();
            $error = "This Charter is set to default and cannot be deleted";
            echo TemplateEngine::View("Pages.Backend.Charters.index",["url"=>$url,"charters"=>$charters,"error"=>$error]);
        }
        else
        {
            $charters->delete();
            redirect($url->make("auth.admin.charters.home"));
        }



    }

}