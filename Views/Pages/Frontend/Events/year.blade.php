@extends("Layouts.main")

@section("title")
    Find Event by Year
@endsection

@section("content")

    @if($events->count() ==0)
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 head">No Events Found</div>
                <div class="col-sm-12 text-center">Sorry! it seems that no events have been found for this request, Please try again later.
                    <br><br>Think this is an error <a href="{{$url->make("contact-us")}}">Please Contact us</a></div>
            </div>
        </div>
        @else
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-lg-9">
                <div class="row my-1">
                @foreach($events as $event)
                        <div class="col-sm-12 col-lg-4">
                            <div class="col-sm-12 head  px-0">{{$event->title}}</div>
                            <div class="col-sm-12 my-2 mx-0 p-0"><img class=" w-100" height="150px" src="/img/uploads/{{$event->image->name}}" alt="{{$event->title}}"></div>
                            <div class="col-sm-12 text-center text-lg-right pr-lg-2 lb2 py-2"><a href="{{$url->make("events.view",["slug"=>$event->slug])}}" class="py-2 d-block d-lg-inline">View Event</a></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="row mx-0 px-0 my-2">
                    <div class="col-sm-12 head">
                        Events by year
                    </div>
                @foreach($years as $year)
                        <div class="col-sm-12 text-center">
                            <a class="py-2 d-block" href="{{$url->make("events.view.year",["year"=>$year->year])}}">{{$year->year}}</a>
                        </div>
                    @endforeach
                </div>

                <div class="row px-0 my-2 mx-0">
                    <div class="col-sm-12 head">Event Contributers</div>
                @foreach($contributers as $member)
                        <div class="col-sm-12 text-center py-2">
                            <a href="{{$url->make("profile.view",["username"=>$member->user->username])}}" class="d-block py-2">
                                {{$member->user->Fullname($member->user_id)}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
