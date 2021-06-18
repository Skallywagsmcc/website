@extends("Layouts.main")

@section("title")
    Events viewer
    @endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 ">
                <div class="col-sm-12 head">Event : {{$event->title}}</div>
                <div class="col-sm-12 ">{{$event->content}}</div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-8 text-center text-md-left">This event has {{$likes->Likes($event->uuid)->count()}} Likes</div>
                    <div class="col-sm-12 col-md-4 text-md-right text-center pr-md-5">{{$likes->links($event->uuid)}}</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head">Event Details</div>
                <div class="col-sm-12 text-center">Event Start date : {{date("d/m/y",strtotime($event->start))}}</div>
                <div class="col-sm-12 text-center">Event Start Time : {{date("H:i:s",strtotime($event->start))}}</div>
                <hr>
                <div class="col-sm-12 text-center">Event End date : {{date("d/m/y",strtotime($event->end))}}</div>
                <div class="col-sm-12 text-center">Event End Time : {{date("H:i:s",strtotime($event->end))}}</div>
                <hr>
                <div class="col-sm-12 text-center">Event Created by {{$event->user->username}}</div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-12">
                <div class="col-sm-12 head">Image Gallery and Reviews</div>
            </div>
        </div>
    </div>
    @endsection
