@extends("Layouts.main")

@section("title")
    Our Events
@endsection

@section("content")

    <div class="container my-2">

        <div class="row">
            <div class="col-sm-12 head my-2">Next Upcoming Event</div>
            <div class="col-sm-12 col-md-3 h-25">
                <img src="/img/uploads/{{$first->image->name}}" class="img-fluid" alt="{{$first->image->name}}-{{$first->id}}">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-2 info text-center text-md-left col-md-6">
                <div class="title">Event : {{$first->title}}</div>
            </div>
            <div class="col-sm-12 info col-md-6">
                <div class="text-md-right pr-2 py-2 text-center">View Info</div>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row px-2">
            <div class="col-sm-12 col-md-3">
                <div class="head text-left my-2">Events by year</div>
                @foreach($years as $year)
                    <div class="text-center py-1 info">
                        {{$year->year}}
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-9">
                @foreach($next as $next)
                    <div class="row my-2">
                        <div class="col-sm-12 col-md-3 h-25">
                            <img src="/img/uploads/{{$next->image->name}}" class="img-fluid" alt="{{$next->image->name}}-{{$next->id}}">
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-12 col-md-9 py-md-2 text-center py-2 title text-md-left pl-md-2">{{$next->title}}</div>
                        <div class="col-sm-12 col-md-3 text-center text-md-right py-2"><a class="d-block" href="{{$url->make("events.view",["slug"=>$next->slug])}}">More info</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection