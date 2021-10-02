@extends("Layouts.main")
@section("title")
    Skallywagsmcc Article {{ $article->slug }}
@endsection

@section("content")
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-12 col-md-2 text-center">
                <div class="col-sm-12 head">By Year</div>
                @foreach($years as $year)
                    <a href="{{$url->make("articles.year",["year"=>$year->year])}}">  {{$year->year}}</a>
                    <br>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="col-sm-12 head">
                    {{$article->title}}
                </div>

                {!! nl2br($article->content) !!}

                <div class="row my-1">
                    <div class="col-sm-12">
                        <a href="{{$url->make("articles.home")}}">Back to Articles</a>
                    </div>
                    <div class="col-sm-12 col-lg-8 text-center text-lg-left pl-lg-2 py-2">Article created by {{$article->user->Profile->first_name}} {{$article->user->Profile->last_name}}</div>
                    <div class="col-sm-12 col-lg-4 text-center text-lg-right pr-lg-2 py-2">
                        @if($article->created_at == $article->updated_at)
                            Created : {{date("H:i",strtotime($article->created_at))}} {{date("d/m/Y",strtotime($article->created_at))}}
                        @else
                            Updated : {{date("H:i",strtotime($article->updated_at))}} {{date("d/m/Y",strtotime($article->updated_at))}}
                        @endif
                    </div>
                </div>

            </div>

            {{--                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
            {{--                        <ol class="carousel-indicators">--}}
            {{--                            @foreach($images as $index => $image)--}}
            {{--                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}" class=" @if($index == 0) active @endif"></li>--}}
            {{--                            @endforeach--}}
            {{--                        </ol>--}}
            {{--                        <div class="carousel-inner">--}}
            {{--                      --}}
            {{--                        </div>--}}
            {{--                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
            {{--                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
            {{--                            <span class="sr-only">Previous</span>--}}
            {{--                        </a>--}}
            {{--                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
            {{--                            <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
            {{--                            <span class="sr-only">Next</span>--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--            <div class="border border-light col-sm-12"></div>--}}
            {{--            <div class="row"></div>--}}
            {{--            <div class="col-sm-12 col-md-6">Posted By : {{$article->user->username}}</div>--}}
            {{--            <div class="col-sm-12 col-md-6">Posted on : {{$article->created_at}}</div>--}}
            {{--        </div>--}}
        </div>
    </div>


@endsection
