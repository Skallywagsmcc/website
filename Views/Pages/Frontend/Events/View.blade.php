@extends("Layouts.main")

@section("title")
    Events viewer {{$event->title}}
@endsection

@section("content")

    <div class="container my-2">
        <div class="row mx-1">
            <div class="col-sm-12 head">Our Events </div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">


                <div class=" col-xs-12 px-0" id="cover_image">
                    @if(is_null($event->cover))
                    <img src="/Assets/img/coverphoto.png" alt=" {{$user->username}} Profile Image">
                    @else
                    <img src="/img/uploads/covers/{{$event->Cover->name}}" alt=" {{$user->username}} Profile Image">
                    @endif
                </div>
                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/{{$event->image->name}}" class="profile_pic justify-content-center"
                                                                height="150" width="150" alt=" {{$event->image->title}}"></div>
            </div>

            <div class="col-sm-12" id="profile_name">{{$event->title}} </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1">
            <div class="col-sm-12 head">About The event</div>
            <div class="col-sm-12 lb2 py-2 my-1 text-center">{!!  nl2br($event->content) !!}</div>
        </div>
    </div>




    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="head">Event Details</div>
                <div class="lb2 my-md-1 py-2 text-center">Event Start : {{date("H:i",strtotime($event->start_at))}} on {{date("d/m/Y",strtotime($event->start_at))}}</div>
                <div class="lb2 my-md-1 py-2 text-center">Event End : {{date("h:iA",strtotime($event->start_at))}} {{date("d/m/Y",strtotime($event->start_at))}}</div>

                <div class="row mx-0 my-2">
                    <div class="col-sm-12 lb2  col-lg-4 py-2 text-md-right d-flex justify-content-center"><img src="/img/uploads/{{$event->user->Profile->Image->name}}" alt="" class="profile_pic  my-2" height="50" width="50"></div>
                    <div class="col-sm-12 lb2 col-lg-8 py-2 text-center  d-block">
                        <div class="text-center lb2">Event Created by</div>
                        <div>
                            <a class="py-2 py-md-0 lb2 text-center" href="{{$url->make("profile.view",["username"=>$event->user->username])}}">{{$event->user->username}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $startlocation = explode(",",$event->esl);
                $endlocation = explode(",",$event->eel);
            @endphp
            <div class="col-sm-12 col-lg-8">
                <div class="head">Journey Overview</div>
                <div class=" my-md-1 py-2">
                    <div class="row mx-0 text-center">
                        <div class="col-sm-12 col-lg-5 lb2 my-2 text-center">
                             From : {{$startlocation[0]}},<br>
                            {{$startlocation[4]}} </div>
                        <div class="col-sm-12 col-lg-2 lb2 d-none d-md-block my-2 py-3"> -> </div>
                        <div class="col-sm-12 col-lg-5 lb2  my-2 text-center">
                            To : {{ $endlocation[0]}},<br>
                            {{$endlocation[4]}}</div>
                    </div>
                    <div class="lb2 .col-sm-12 my-md-1 text-center py-2">
                        @if(empty($event->map_url))
                            No Map Address is linked to this event
                        @else
                        <a href="{{$event->map_url}}">View Map</a>
                            @endif
                    </div>

                </div>

                <div class="head mt-2">Meet up Location </div>
                <div class="lb2 my-md-1 py-2 text-center text-md-left pl-md-3">
                    House or buildiing Name / number : {{$startlocation[0]}},<br>
                    Street : {{$startlocation[1]}},<br>
                    City : {{$startlocation[2]}},<br>
                    County : {$startlocation[3]}},<br>
                    Post Code : {{$startlocation[4]}}
                </div>

                <div class="head mt-2">Event Destination </div>
                <div class="lb2 my-md-1 py-2 text-center text-md-left  pl-md-3">
                    House or buildiing Name / number : {{$endlocation[0]}},<br>
                    Street : {{$endlocation[1]}},<br>
                    City : {{$endlocation[2]}},<br>
                    County : {{$endlocation[3]}},<br>
                    Post Code : {{$endlocation[4]}}
                </div>
            </div>
        </div>
    </div>



@endsection
