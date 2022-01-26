<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Event;
use App\Libraries\LikesManager\LikeManager;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    private $entity_name;

    public function __construct()
    {
        $this->entity_name = "page/events";
    }

    public function index(Url $url)
    {
//        this needs redoing
        $events = Event::orderBy("id","desc");
        $contributers = Event::groupBy("user_id")->get();
        $paginate = new LaravelPaginator("5","page");
        $events = $paginate->paginate($events);
        $years = Event::selectRaw('year(start_at) year')->groupBy('year')->orderBy('year','desc')->limit(5)->get();
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.index",["url"=>$url,"events"=>$events,"contributers"=>$contributers,"links"=>$links,"years"=>$years]);
    }

    public function show($slug,Url $url)
    {
        $event = Event::where("slug",$slug)->get();

        if($event->count()==1)
        {
            $event = $event->first();
            echo TemplateEngine::View("Pages.Frontend.Events.View",["url"=>$url,"event"=>$event]);
        }
        else
        {
            echo "Not found";
        }
    }


    public function view($year,Url $url)
    {
        $events = Event::whereYear('start_at', $year);
        $contributers = Event::groupBy("user_id")->get();
        $years = Event::selectRaw('year(start_at) year')->groupBy('year')->orderBy('year','desc')->limit(5)->get();
        $paginate = new LaravelPaginator("5","page");
        $events = $paginate->paginate($events);
        $links = $paginate->page_links();
        echo TemplateEngine::View("Pages.Frontend.Events.year",["url"=>$url,"events"=>$events,"links"=>$links,"contributers"=>$contributers,"years"=>$years]);
    }

    public function search(Url $url, ServerRequest $request)
    {
       $meetup = $request->getQueryParams()['meetup'];
       $destination = $request->getQueryParams()['destination'];

     echo  Event::where("esl","LIKE","%$meetup%")->where("eel","LIKE","%$destination%")->get()->count();
    }
}