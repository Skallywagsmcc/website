<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class EventTimeline extends Controller
{

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
