<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Event;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    public function index(Url $url)
    {
        $events = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url]);
    }

    public function show(Url $url)
    {
    }

    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf)
    {
        if($csrf->Verify() == true) {
            $event = new Event();
            $event->uuid = $validate->uuid();
            $event->title = ucwords($validate->Required("title")->Post());
            $event->slug = slug($event->title . '-' . date('d-m-Y', strtotime($validate->Post("start"))));
            $event->content = $validate->Post("content");
            $event->start = $validate->Required("start")->Post();
            $event->end = $validate->Required("end")->Post();
            $event->address = trim($validate->Required("name")->Post() . ",");
            $event->address .= trim($validate->Required("street")->Post() . ",");
            $event->address .= trim($validate->Required("city")->Post() . ",");
            $event->address .= trim($validate->Required("county")->Post() . ",");
            $event->address .= trim($validate->Required("postcode")->Post() . ",");
            $event->save();

            echo $event->id;
            if ($validate->Post("route") == 1) {
                redirect($url->make("auth.admin.events.routes.home", ["id" => base64_encode($event->id)]));
            } else {
                redirect($url->make("auth.admin.events.home"));
            }
        }


    }

    public function edit(Url $url, $id, Validate $validate)
    {
        $id = base64_decode($id);
        $event = Event::find($id);
        $address = explode(",", $event->address);
        echo TemplateEngine::View("Pages.Backend.Events.edit", ["event" => $event, "address" => $address, "url" => $url]);
    }

    public function update(Validate $validate, Url $url,Csrf $csrf)
    {
        if($csrf->Verify() == true) {
            $id = $validate->Post("id");
            $event = event::find($id);
            $event->title = ucwords($validate->Required("title")->Post());
            $event->slug = slug($event->title . '-' . date('d-m-Y', strtotime($validate->Post("start"))));
            $event->content = $validate->Post("content");
            if ($validate->Post("ms") == 1) {
                $event->start = $validate->Required("start")->Post();
            }
            if ($validate->Post("me") == 1) {
                $event->end = $validate->Required("end")->Post();
            }
            $event->address = trim($validate->Required("name")->Post() . ",");
            $event->address .= trim($validate->Required("street")->Post() . ",");
            $event->address .= trim($validate->Required("city")->Post() . ",");
            $event->address .= trim($validate->Required("county")->Post() . ",");
            $event->address .= trim($validate->Required("postcode")->Post() . ",");
            $event->save();

            redirect($url->make("admin.events.home"));
        }
    }

    public function delete(Url $url,Csrf $csrf, Validate $validate,Auth $auth)
    {
        if($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                $id = $validate->Post("id");
                for ($i = 0; $i < count($id); $i++) {
                    Event::destroy($validate->Post("id")[$i]);
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $message = "Your Password Has been entered Wrong, Please try again";

            }
        }
        else
        {
            $message = "your Csrf Token is not valid";
        }
        $events = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url,"message"=>$message]);
    }

}