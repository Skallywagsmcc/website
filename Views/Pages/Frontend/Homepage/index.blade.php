@extends("Layouts.main")
@section("title")
    (Home)
@endsection
@section("content")

<div class="container">
    <div class="row my-1">
        <div class="col-sm-12 head">Updates</div>
        <div class="col-sm-12">18/06/2021 : We are currently working on the layout and other small improvements to the frontend of the site</div>
    </div>
    <div class="row my-1">
        <div class="col-sm-12 head">Beta Notice</div>
        <div class="col-sm-12">
            Welcome: although this site is operational, the site is in Beta which means some things may break and some things may change all change and code can be found <a href="http://github.com/skallywagsmcc">Here</a>
            <hr>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row info my-2 text-center py-2">
            @if($events->count() == 0)
                <div class="col-sm-12">No Upcoming events</div>
                @else
            <div class="col-sm-12 col-md-3">Next Upcoming Event</div>
            <div class="col-sm-12 col-md-9">This is coming soon</div>
                @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head pl-3 mb-1">Welcome to Skallywags</div>
            <div class="col-sm-12">
                <iframe class="p-0 text-right" width="100%" height="315"
                        src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head">Featured Images</div>
            @if($featured->count() >= 1)
                @foreach($featured as $image)
                <div class="col-sm-12 col-md-4 my-2">
                    <div class="col-sm-12">
                        <img class="border border-primary" src="/img/uploads/{{$image->Image->image_name}}" width="250"
                             height="250" alt=""/>
                    </div>
                    <div class="col-sm-12 text-sm-center text-right">
                        <a href="{{$url->make("gallery.home",["username"=>$image->Image->user->username])}}">{{$image->Image->user->username}}</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-sm-12">No Featured images added</div>
            @endif
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 head">Latest Articles</div>
                @foreach($pages as $page)
                    <div class="col-sm-12">
                        <a href="{{$url->make("articles.view",["slug"=>$page->slug])}}">{{$page->title}}</a>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head">Newest Club Member</div>
                <img src="/img/uploads/{{$member->first()->User->Profile->image->image_name}}"  height="200px" width="100%" alt="{{$member->first()->User->username}} Profile Image" class="my-1">
                <div class="col-sm-12 text-right"><a href="{{$url->make("members.home")}}">All members</a></div>
            </div>
        </div>
    </div>
@endsection