@extends("Layouts.main")

@section("title")
    Find Event by Year
@endsection

@section("content")
    <div class="container">

        @foreach($events as $event)
            <div class="row text-center my-2">
                <div class="col-xs-12 col-sm-12 col-md-3 my-3 my-md-0"><img src="/img/uploads/{{$event->image->name}}"
                                                                            class="img-thumbnail"
                                                                            alt="{{$event->image->name}}" height="70px">
                </div>
                <div class="col-sm-12 col-md-5">{{$event->title}}</div>
                <div class="col-sm-12 col-md-4"><a href="{{$url->make("events.view",["slug"=>$event->slug])}}">View
                        Event</a></div>
            </div>
        @endforeach

    </div>

    <div class="container">
        <div class="row my-3">
            <div class="col-sm-12 d-flex justify-content-center">{!! $links !!}</div>
        </div>
    </div>



@endsection