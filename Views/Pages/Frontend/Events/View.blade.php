@extends("Layouts.main")

@section("title")
    Events viewer {{$event->title}}
    @endsection

@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center h-50">
                <img src="/img/uploads/{{$event->image->name}}" class="h-50 img-fluid w-50" alt="">
            </div>
        </div>
        <h2 class="col-sm-12 title text-center p-2 my-1">{{$event->title}}</h2>
        <hr>
    </div>
    <div class="container my-2">
        <div class="block">
            <div class="row">
                <div class="col sm-12">About the script</div>
                <div class="col-sm-12 nextbtn"><a href="#">About the </a></div>
            </div>
        </div>
        <div class="block">
            <div class="row">
                <div class="col sm-12">Date and timet</div>
                <div class="col-sm-12 prevbtn"><a href="#">About the </a></div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="head">Event Details</div>
                <div class="d-flex justify-content-center m-1"><img src="/img/uploads/{{$event->user->Profile->image->name}}" alt="{{$event->user->username}} Profile image" class="h-50 img-fluid w-50"></div>
                <div class="text-center p-2">
                    Created by : {{$event->user->username}}
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="head">About the Event</div>
                {{$event->content}}
            </div>
        </div>

        <div class="row text-center my-2">
            <div class="col-sm-12 col-md-4 py-3 ">Event Start : {{date("d/m/y",strtotime($event->start))}}</div>
            <div class="col-sm-12 col-md-4 d-none d-md-block"></div>
            <div class="col-sm-12 col-md-4 py-3">{{date("d/m/y",strtotime($event->start))}}</div>
        </div>

    </div>



    @endsection
