@extends("Layouts.main")

@section("title")
    {{$_SERVER['APP_NAME']}} Search Results
@endsection

@section("content")
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{$url->make("search.view")}}" method="get" class="tld-form">
                    <input type="text" name="keyword" class="tld-input form-control my-2"
                           placeholder="Search for Users, Articles ,Charters or Events">
                    <button class="tld-button btn-block btn">Search</button>
                </form>
            </div>
        </div>
    </div>
@if(empty($keyword) or !isset($keyword))
    <div class="container my-2">
        <div class="row mx-1">
            <div class="col-sm-12 head">No search Results found</div>
            <div class="col-sm-12 text-center">Sorry it seems you have entered an invalid Request</div>
        </div>
    </div>
@else


    @isset($type)
        @if($type == "users")
            <div class="container my-2">
                <div class="row">
                    Users
                    @if($users->count() >=1)
                        <div class="col-sm-12 head">Results for users</div>
                        @foreach($users as $user)
                            {{$user->username}}
                        @endforeach
                        <div class="col-sm-12 text-center text-lg-right pr-lg-2">
                            {!! $p["users"] !!}
                        </div>
                    @else
                        No Results found in users
                    @endif
                </div>
            </div>
        @elseif("$type" == "articles")
            <div class="container my-2">
                <div class="row">
                    @if($articles->count() >=1)
                        <div class="col-sm-12 head">Results for Articles</div>
                        @foreach($articles as $article)
                            <div class="col-sm-12">
                                {{$article->title}}
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center col-sm-12">
                            {!!$p["articles"]!!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($type=="charters")
            <div class="container my-2">
                <div class="row">
                    @if($charters->count() >=1)
                        <div class="col-sm-12 head">Results for Charters</div>
                        @foreach($charters as $charter)
                            {{$charter->title}}
                            <br>
                        @endforeach
                        <div class="d-flex justify-content-center col-sm-12">
                            {!!$p["charters"]!!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($type=="events")
            <div class="container my-2">
                <div class="row">
                    @if($events->count() >=1)
                        <div class="col-sm-12 head">Results for Events</div>
                        @foreach($events as $event)
                            {{$event->title}}
                            <br>
                        @endforeach
                        <div class="d-flex justify-content-center col-sm-12">
                            {!!$p["events"]!!}
                        </div>
                    @endif
                </div>
            </div>
        @else
            No Results
        @endif
    @else
        <div class="container my-2">
            <div class="row">
                @if($users->count() >=1)
                    <div class="col-sm-12 head">Results for users</div>
                    @foreach($users as $user)
                        {{$user->username}}

                    @endforeach
                    @if($users->count() == $limit)
                        <div class="col-sm-12 text-center text-lg-right pr-lg-2">
                            <a href="{{$url->make("search.view.type",["type"=>"users"])}}?keyword={{$keyword}}">View More
                                Users</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="container my-2">
            <div class="row">
                @if($articles->count() >=1)
                    <div class="col-sm-12 head">Results for Articles</div>
                    @foreach($articles as $article)
                        <div class="col-sm-12">
                            {{$article->title}}
                        </div>
                    @endforeach
                    @if($articles->count() == $limit)
                        <div class="col-sm-12 text-center text-lg-right pr-lg-2">
                            <a href="{{$url->make("search.view.type",["type"=>"articles"])}}?keyword={{$keyword}}">View More
                                Articles</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="container my-2">
            <div class="row">
                @if($charters->count() >=1)
                    <div class="col-sm-12 head">Results for Charters</div>
                    @foreach($charters as $charter)
                        {{$charter->title}}
                        <br>
                    @endforeach
                    @if($charters->count() == $limit)
                        <div class="col-sm-12 text-center text-lg-right pr-lg-2">
                            <a href="{{$url->make("search.view.type",["type"=>"charters"])}}?keyword={{$keyword}}">View More
                                Charters</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="container my-2">
            <div class="row">
                @if($events->count() >=1)
                    <div class="col-sm-12 head">Results for Events</div>
                    @foreach($events as $event)
                        {{$event->title}}
                        <br>
                    @endforeach
                    @if($events->count() == $limit)
                        <div class="col-sm-12 text-center text-lg-right pr-lg-2">
                            <a href="{{$url->make("search.view.type",["type"=>"events"])}}?keyword={{$keyword}}">View More
                                Events</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    @endisset
    @endif
@endsection