@extends("Layouts.main")

@section("title")
    Events viewer
    @endsection

@section("content")
    <div class="container">
        <div class="row">
                <div class="col-sm-12 col-md-8 text-center text-md-left pl-md-2 py-2 info">Event : {{$event->title}}</div>
                <div class="col-sm-12 col-md-4 text-center py-2 info">Event Start time : {{date("d/m/y",strtotime($event->start))}}</div>

        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                    <div class="head">Event Details</div>
                    <div class="info my-1">Stopping Points</div>

            </div>
            <div class="col-sm-12 col-md-8">
                    <div class="head">About the event</div>
                    <div class="col-sm-12 my-2 info">
                        {{$event->content}}
                    </div>

            </div>
        </div>

    </div>

    <div class="profile_pic">
        <img src="/img/uploads/{{$event->user->Profile->Image->name}}" height="50" width="50" alt="{{$event->user->username}} Profile Image">
    </div>

    <div class="col-sm-12">{{$event->user->username}}</div>
    @endsection
