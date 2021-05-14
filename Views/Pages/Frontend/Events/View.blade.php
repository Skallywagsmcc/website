@extends("Layouts.main")

@section("title")
    Events viewer
    @endsection

@section("content")
    <div class="container">
        <div class="row">
            <div></div>
        </div>
    </div>
    @endsection class="col-sm-12 head">{{$event->title}}</div>
<div class="col-sm-12">
    {{$event->content}}
</div>
this is event will start at {{$event->start}} at {{date("H:i:s",strtotime($event->start))}}
<div class="col-sm-12 text-right">{{date("d/m/Y",strtotime($event->created_at))}} {{date("h:i:s a",strtotime($event->created_at)) }}</div>
{{--            images may be able