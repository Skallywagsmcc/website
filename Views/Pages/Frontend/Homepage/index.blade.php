@extends("Layouts.main")
@section("title")
    (Home)
@endsection
@section("content")
    <div class="container">
        <div class="jumbotron p-0 m-0">
            <img src="/img/sky.jpg" style="  clip: rect(0px,200px 0px,0px);" width="100%" alt="Bike Image">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head"></div>
        </div>
        <div class="row py-2">
            @foreach($featured as $image)
                <div class="col-sm-12 col-md-3">
                    <div class="col-sm-12 p-1">
                        <img class="border border-primary" src="/img/uploads/{{$image->Image->image_name}}" width="250"
                             height="250" alt=""/>
                    </div>
                    <div class="col-sm-12 text-center"> Uploaded By : <a
                                href="{{$url->make("gallery.home",["username"=>$image->Image->user->username])}}">{{$image->Image->user->username}}</a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid bg-dark border-top border-bottom border-light p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 p-0 ">
                    <div class="col-sm-12 head my-1">Welcome To Skallywags MCC</div>
                    <div class="col-md-12 ">
                        <iframe class="p-0 m-0 text-right" width="100%" height="315"
                                src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="col-sm-12 my-1 head">Latest Pages</div>
                    <div class="col-sm-12 text-center">
                        @foreach($pages as $page)
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{$url->make("articles.view",["slug"=>$page->slug])}}"> {{$page->title}}
                                        k</a>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right">
                                    {{date("H:i:s d/m/Y",strtotime($page->updated_at))}}
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row py-2 my-1">
            <div class="col-sm-12 head">Upcoming events</div>
            @foreach(events() as $event)
                <div class="col-sm-12 col-md-6 text-sm-center text-md-left pl-md-3"> {{$event->title}}</div>
                <div class="col-sm-12 col-md-6 text-sm-center text-md-right"> {{date("d/m/Y - H:i:s a",strtotime($event->start))}}</div>

            @endforeach
            <div class="col-sm-12 text-right"><a href="{{$url->make("events.home")}}"See More Events</a></div>
        </div>
    </div>



@endsection