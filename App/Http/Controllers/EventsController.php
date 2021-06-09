<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Event;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    public function index(Url $url)
    {
        $events = Event::all();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events]);
    }

    public function show($id,Url $url)
    {
        $id = base64_decode($id);
        $event = Event::where("id",$id)->get();
        if($event->count()==1)
        {
            $event = $event->first();
            echo TemplateEngine::View("Pages.Frontend.Events.View",["url"=>$url,"event"=>$event]);
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