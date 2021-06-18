<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Event;
use App\Libraries\LikesManager\LikeManager;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    public function index(Url $url)
    {
        $events = Event::all();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events]);
    }

    public function show($slug,Url $url)
    {
        $event = Event::where("slug",$slug)->get();
        if($event->count()==1)
        {
            $likes = new LikeManager();
            $event = $event->first();
            echo TemplateEngine::View("Pages.Frontend.Events.View",["url"=>$url,"event"=>$event,"likes"=>$likes]);
        }


    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {
//        May Allow deletion from here.

    }

}