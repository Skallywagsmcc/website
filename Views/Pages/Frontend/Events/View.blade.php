@extends("Layouts.main")

@section("title")
    Events viewer {{$event->title}}
@endsection

@section("content")

    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-sm-12 px-0" id="cover_image">
                    <img src="/Assets/img/coverphoto.png" alt=" {{$user->username}} Profile Image" width="100%">
                </div>

                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/{{$event->image->name}}" class="profile_pic justify-content-center"
                                                                height="150" width="150" alt=" {{$event->image->title}}"></div>
            </div>

            <div class="col-sm-12" id="profile_name">{{$event->title}} </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row">

            <div class="col-sm-12">
                <div class="head text-center text-md-left pl-md-1 px-0 lb3 ">{{$event->title}}</div>
                <div class="text-center text-md-left pl-md- lb2 my-1">
                    {{$event->content}}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head">
                    Event Start time and date
                </div>
                <div class="col-sm-12 py-2 text-center">
                    {{date("h:iA",strtotime($event->start_at))}} {{date("d/m/Y",strtotime($event->start_at))}}
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head">
                    Event end time and date
                </div>
                <div class="col-sm-12 py-2 text-center">
                    {{date("h:iA",strtotime($event->end_at))}} {{date("d/m/Y",strtotime($event->end_at))}}
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head text-center text-md-left">Event Route</div>
                @php
                $startlocation = explode(",",$event->esl);
                $endlocation = explode(",",$event->eel);
                @endphp

                <div class="col-sm-12 py-2 text-center">
                    {{$startlocation[0]}} -> {{ $endlocation[0]}}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head">Map of our Route</div>
            <div class="col-sm-12 text-center">
                @if(empty($event->map_url))
                    No Map Address has been linked to this event Please contact us for more information
                @else
                    <a href="{{$event->map_url}}" target="_new">View Map</a>

                @endif
            </div>

        </div>
    </div>
@endsection
