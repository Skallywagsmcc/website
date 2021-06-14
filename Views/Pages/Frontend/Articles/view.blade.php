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
                    <a href="{{$url->make("articles.year",["year"=>\Carbon\Carbon::parse($year->created_at)->format("Y")])}}">  {{\Carbon\Carbon::parse($year->created_at)->format("Y")}}</a>
                    <br>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="col-sm-12 head">
                    {{$article->title}}
                </div>

                {!! nl2br($article->content) !!}
                <div class="col-sm-12 foot py-2 px-0 m-0">
                    <a href="#" data-toggle="modal" data-target="#Likes">{{$likes->Likes($article->uuid)->count()}} People
                        Like this</a>
                    {!! $likes->links($article->uuid)!!}
                </div>

                <div class="row my-1">
                    <div class="col-sm-12">
                        <a href="{{$url->make("articles.home")}}">Back to Articles</a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal t h-100 overflow-auto moda fade" id="Likes" tabindex="-1" role="dialog"
                     aria-labelledby="Likes" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-primary">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="Likes">People who Have liked this article</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg-dark text-white">

                                @foreach($likes->Likes($article->uuid); as $like)
                                    <a href="{{$url->make("profile.home",["username"=>$like->user->username])}}">{{$like->user->username}}</a>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($images as $image)
                        <div class="col-sm-12 col-md-4">
                            <div class="col-sm-12">
                                <img height="200px" width="200px" src='/img/uploads/{{$image->image_name}}'>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">{{$likes->Likes($image->uuid)->count()}} </div>
                                <div class="col-sm-12 col-md-6">{!! $likes->links($image->uuid)!!}</div>
                            </div>

                        </div>

                    @endforeach
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
