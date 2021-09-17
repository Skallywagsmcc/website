<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Event;
use App\Libraries\LikesManager\LikeManager;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    public function index(Url $url)
    {
//        this needs redoing

        $first = Event::orderBy("id","desc")->limit(1)->get()->first();
        $events = Event::whereraw("id","<",$first->id)->orderBy("start_at","desc");
//        $first = Event::where("end_at",">=",date("Y-m-d"))->orderBy("id","asc")->limit(1)->get()->first();
//        $events = Event::Where("start_at",">",date("Y-m-d",strtotime($first->end_at)))->where("id","!=",$first->id)->Orderby("id","Asc");
        $paginate = new LaravelPaginator("5","page");
        $events = $paginate->paginate($events);
        $years = Event::selectRaw('year(start_at) year')->groupBy('year')->orderBy('year','desc')->limit(5)->get();
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events,"first"=>$first,"links"=>$links,"years"=>$years]);
    }

    public function show($slug,Url $url)
    {
        $event = Event::where("slug",$slug)->get();
        if($event->count()==1)
        {
            $event = $event->first();
            echo $event->id;
//            echo TemplateEngine::View("Pages.Frontend.Events.View",["url"=>$url,"event"=>$event]);
        }
        else
        {
            echo "Not found";
        }
    }


    public function view($year,Url $url)
    {
        $events = Event::whereYear('start_at', $year);
        $paginate = new LaravelPaginator("5","page");
        $events = $paginate->paginate($events);
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.year",["url"=>$url,"events"=>$events,"links"=>$links]);
    }
}