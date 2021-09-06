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
            <div class="col-sm-12 col-md-9 d-none d-md-block">
                {{substr($first->content,"0","100")}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row info">
            <div class="col-sm-12 py-2 info text-center text-md-left col-md-6">
                <div class="title">Event : {{$first->title}}</div>
            </div>
                <div class="col-sm-12 col-md-6 text-center text-md-right py-2"><a class="d-block" href="{{$url->make("events.view",["slug"=>$first->slug])}}">More info</a></div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row px-2">
            <div class="col-sm-12 col-md-3">
                <div class="head text-left my-2">Events by year</div>
                @foreach($years as $year)
                    {{$year->year}}
                @endforeach
            </div>
            <div class="col-sm-12 col-md-9">
                @if($events->count() ==0)
                    <div class="head my-2">No Events Found</div>
                    <div class="info p-2">No upcoming events have been found Please check back later</div>
                    @else
                @foreach($events as $event)
                    <div class="row my-2">
                        <div class="col-sm-12 col-md-3 h-25">
                            <img src="/img/uploads/{{$event->image->name}}" class="img-fluid" alt="{{$event->image->name}}-{{$event->id}}">
                        </div>
                        <div class="col-sm-12 col-md-9 d-none d-md-block">
                            {{substr($event->content,"0","100")}}
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-12 col-md-9 py-md-2 text-center py-2 title text-md-left pl-md-2">{{$event->title}}</div>
                        <div class="col-sm-12 col-md-3 text-center text-md-right py-2"><a class="d-block" href="{{$url->make("events.view",["slug"=>$event->slug])}}">More info</a></div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 justify-content-center d-flex">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection