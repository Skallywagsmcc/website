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
//        $events = Event::all();
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $first = Event::whereDay("start","<=",$day)->whereMonth("start","<=",$month)->whereYear("start","<=",$year)->get()->first();
        $paginate = new LaravelPaginator("5","page");
        $next = Event::whereDay("start",">",$day)->whereMonth("start",">=",$month)->whereYear("start",">=",$year)->limit(4);
        $events = $paginate->paginate($next);
        $links = $paginate->page_links();
        $years = Event::selectRaw('year(start) year')->groupBy('year')->orderBy('year','desc')->limit(5)->get();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events,"years"=>$years,"first"=>$first,"next"=>$next,"links"=>$links]);
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


    public function view($year,Url $url)
    {
        $events = Event::whereYear('start', $year);
        $paginate = new LaravelPaginator("5","page");
        $events = $paginate->paginate($events);
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.year",["url"=>$url,"events"=>$events,"links"=>$links]);
    }
}