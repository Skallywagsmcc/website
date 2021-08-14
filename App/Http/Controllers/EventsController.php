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
        $events = Event::all();
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $first = Event::whereDay("created_at","<=",$day)->whereMonth("created_at","<=",$month)->whereYear("created_at","<=",$year)->get()->first();
        $next = Event::whereDay("created_at",">",$day)->whereMonth("created_at",">=",$month)->whereYear("created_at",">=",$year)->limit(4)->get();
        $years = Event::selectRaw('year(created_at) year')->groupBy('year')->orderBy('year','desc')->limit(5)->get();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events,"years"=>$years,"first"=>$first,"next"=>$next]);
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
        $events = Event::whereYear('created_at', $year);
        $paginate = new LaravelPaginator("4","page");
        $events = $paginate->paginate($events);
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.year",["url"=>$url,"events"=>$events,"links"=>$links]);

    }
}