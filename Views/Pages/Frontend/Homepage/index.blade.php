@extends("Layouts.main")
@section("title")
    (Home)
@endsection
@section("content")
    <div class="container">
        <div class="row my-2 text-center py-2 px-0 lb2 mx-2 mx-md-0">
            @if($events->count() == 0)
                <div class="col-sm-12">No Upcoming events</div>
            @else
                <div class="col-sm-12 col-md-2">Next Event :</div>
                <div class="col-sm-12 col-md-6 text-center">
                    @foreach($events  as $event)
                        <a href="{{$url->make("events.view",['slug'=>$event->slug])}}">{{$event->title}}</a>
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-3">
                    @foreach($events as $event)
                        @if(date("d/m/Y",strtotime($event->start_at)) == date("d/m/Y"))
                            {{--                            Detect start time--}}
                            @if(date("H:i:s",strtotime("+1 Hour")) < date("H:i:s",strtotime($event->start_at)))
                                Event today at {{date("H:i:s",strtotime($event->start_at))}}
                                {{--                        Detect end time--}}
                                Event start at : {{date("H:i:s",strtotime($event->start_at))}}
                            @elseif(date("H:i:s",strtotime("+1 Hour")) > date("H:i:s",strtotime($event->end_at)))
                                Event Ended
                            @else
                                Event starts on {{date("d/m/Y",strtotime($event->start_at))}}
                            @endif
                        @else
                            Event starts on {{date("d/m/Y",strtotime($event->start_at))}}
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>



    <div class="container">
        <div class="row mx-2 mx-md-0 lb2">
            <div class="col-sm-12 head pl-3 mb-1">Welcome to Skallywags</div>
            <div class="col-sm-12 p-md-0">
                <iframe class="p-0 text-right" width="100%" height="315"
                        src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container my-2">

        <form action="{{$url->make("search.view")}}" method="get" class="tld-form">
            <div class="row">
                <div class="col-sm-12 col-lg-9">
                    <input type="text" name="keyword" class="tld-input form-control my-2"
                           placeholder="Search for Users, Articles ,Charters or Events"></div>
                <div class="col-sm-12 col-lg-3 my-2">
                    <button class="tld-button btn-block btn">Search</button>

                </div>
            </div>
        </form>
    </div>

    <div class="container my-2">
        <div class="row mx-2 mx-md-0">
            <div class="col-sm-12 col-lg-9">
                <div class="row my-3 ">
                    <div class="col-sm-12 lb2 head">Featured Images</div>
                    @if($featured->count() >= 1)
                        @foreach($featured as $image)
                            <div class="col-sm-12 col-md-4 my-2">
                                <div class="col-sm-12 text-center">
                                    <img class="border border-primary profile_pic"
                                         src="/img/uploads/{{$image->Image->name}}"
                                         height="150" width="150" alt=""/>
                                </div>
                                <div class="col-sm-12 text-sm-center text-right">
                                    <a href="{{$url->make("profile.gallery.home",["username"=>$image->Image->user->username])}}">{{$image->Image->user->username}}</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-12">No Featured images added</div>
                    @endif
                </div>

                {{--            Artticles--}}

                <div class="row my-sm-2">
                    <div class="col-sm-12  px-0 pr-md-2 mx-4 mx-md-0 lb2">

                        <div class="col-sm-12 head">Latest Articles</div>
                        @if($pages->count() >= 1)
                            @foreach($pages as $page)
                                <div class="col-sm-12 ">
                                    <a href="{{$url->make("articles.view",["slug"=>$page->slug])}}">{{$page->title}}</a>
                                </div>

                            @endforeach
                            <div class="col-sm-12 px-0 text-center text-md-right"><a
                                        href="{{$url->make("articles.home")}}">View
                                    More articles</a></div>
                        @else
                            <div class="col-sm-12 text-center px-0">No Articles Found</div>
                        @endif

                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-lg-3">
                <div class="row mx-2 my-3">
                    <div class="col-sm-12 lb2 head">Latest Members</div>
                    @foreach($members as $member)
                        @if($member->user->status == 3)
                            <div class="col-sm-12 text-center mx-0">
                                <a href="{{$url->make("profile.view",["username"=>$member->user->username])}}"
                                   class="d-block py-2 mx-0 px-0">{{$member->first_name}} {{$member->last_name}}</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>



@endsection