<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\EventTimeline;
use MiladRahimi\PhpRouter\Url;

class EventTimelineController
{

    public function show($id, Url $url)
    {

    }

    public function store(Validate $validate, Csrf $csrf)
    {
        $timeline = new EventTimeline();
        $timeline->event_id = $id;
        $timeline->location = $validate->Post("location");
        $timeline->time = $validate->Post("time");
        $timeline->save();
    }


    public function edit($id)
    {
        echo "hello";
    }

    public function update(Validate $validate, Url $url, Csrf $csrf)
    {

    }
}