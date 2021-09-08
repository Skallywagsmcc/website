@extends("Layouts.main")

@section("title")
    Events viewer {{$event->title}}
@endsection

@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-md-4 d-flex justify-content-center h-75">
                <img src="/img/uploads/{{$event->image->name}}" class="h-75 img-fluid  w-75" alt="">
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="head text-center text-md-left pl-md-1 px-0">{{$event->title}}</div>
                <div class="text-center text-md-left pl-md-2">
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
