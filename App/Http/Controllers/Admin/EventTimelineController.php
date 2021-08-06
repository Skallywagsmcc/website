<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Event;
use App\Http\Models\EventTimeline;
use MiladRahimi\PhpRouter\Url;

class EventTimelineController
{

    public function show($id, Url $url)
    {
        $id = base64_decode($id);
        $event = Event::where("id", $id)->get();
        if ($event->count() == 1) {
            $timelines = EventTimeline::where("event_id", $id)->orderBy("order_id")->get();
            echo TemplateEngine::View("Pages.Backend.Events.Timeline.add", ["url" => $url, "event" => $event->first(), "timelines" => $timelines]);
        } else {
            echo "not found";
        }


    }

    public function store(Url $url, Validate $validate, Csrf $csrf)
    {

        $id = $validate->Post("id");
        if ($csrf->Verify() == true) {
            $et = EventTimeline::where("event_id", $id)->orderBy("id", "DESC")->get();
            if ($et->count() == 0) {
                $order_id = 1;
            } else {
                $order_id = $et->first()->order_id + 1;
            }
            $timeline = new EventTimeline();
            $timeline->event_id = $id;
            $timeline->order_id = $order_id;

            $timeline->location = trim($validate->Post("name") . ",");
            $timeline->location .= trim($validate->Post("street") . ",");
            $timeline->location .= trim($validate->Post("city") . ",");
            $timeline->location .= trim($validate->Post("county") . ",");
            $timeline->location .= trim($validate->Post("postcode") . ",");
            $timeline->save();

            if ($validate->Post("more") == 1) {
                redirect($url->make("auth.admin.events.routes.home", ["id" => base64_encode($timeline->event_id)]));
            } else {
                redirect($url->make("auth.admin.events.edit", ["id" => base64_encode($timeline->event_id)]));
            }
        }

    }

    public function updateorder(Url $url, Validate $validate, Csrf $csrf)
    {
        for($i=0;$i>count($validate->Post("id"));$i++)
        {
            echo $validate->Post("order_id")[$i];
        }
    }


    public function edit($id,Url $url)
    {
        $id = base64_decode($id);
        $timeline = EventTimeline::where("id", $id)->get();
        $location = explode(",",$timeline->first()->location);
        if ($timeline->count() == 1) {
            echo TemplateEngine::View("Pages.Backend.Events.Timeline.edit",["timeline"=>$timeline->first(),"location"=>$location,"url"=>$url]);
        } else {
//            Fail
            echo "nothing";
        }
    }

    public function update(Validate $validate, Url $url, Csrf $csrf)
    {
        if($csrf->Verify()==true) {
            $id = $validate->Post("id");
            $timeline = EventTimeline::where("id", $id)->get();
            if ($timeline->count() == 1) {
                $timeline = $timeline->first();
                $timeline->location = trim($validate->Post("name") . ",");
                $timeline->location .= trim($validate->Post("street") . ",");
                $timeline->location .= trim($validate->Post("city") . ",");
                $timeline->location .= trim($validate->Post("county") . ",");
                $timeline->location .= trim($validate->Post("postcode") . ",");
                $timeline->save();
            echo "saved";
            }
        }
    }
}