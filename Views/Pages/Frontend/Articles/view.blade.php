@extends("Layouts.main")
@section("title")
    Skallywagsmcc Article {{ $article->slug }}
@endsection

@section("content")
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-12 head">
                {{$article->title}}
            </div>
            <div class="col-sm-12">
                {!! nl2br($article->content) !!}
                <br>
                <a href="#" data-toggle="modal" data-target="#exampleModal">{{$likes->count()}}</a>
                <br>
                @if($btn->count() == 1)
                    <a href="{{$url->make("likes.delete",["entry_name"=>$entry_name,"entry_id"=>$article->id])}}">Unlike</a>
                @else
                    <a href="{{$url->make("likes.create",["entry_name"=>$entry_name,"entry_id"=>$article->id])}}">Like</a>
                @endif
            </div>

            <!-- Modal -->
            <div class="modal t h-100 overflow-auto moda fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-primary">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="exampleModalLabel">People who Have liked this article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body bg-dark text-white">
                            @foreach($likes as $like)
                                <a href="{{$url->make("profile.home",["username"=>$like->user->username])}}">{{$like->user->username}}</a> <br>
                            @endforeach
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                            James <br>
                        </div>
                    </div>
                </div>
            </div>

            {{--        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
            {{--            <ol class="carousel-indicators">--}}
            {{--                @foreach($images as $index => $image)--}}
            {{--                <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}" class=" @if($index == 0) active @endif"></li>--}}
            {{--                @endforeach--}}
            {{--            </ol>--}}
            {{--            <div class="carousel-inner">--}}
            {{--                @foreach($images as $index => $image)--}}
            {{--                    <div class="carousel-item @if($index == 0) active @endif ">--}}
            {{--                        <img class="d-block w-100"  height="600px" src='/img/uploads/{{$image->image_name}}'>--}}
            {{--                    </div>--}}
            {{--                @endforeach--}}
            {{--            </div>--}}
            {{--            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
            {{--                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
            {{--                <span class="sr-only">Previous</span>--}}
            {{--            </a>--}}
            {{--            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
            {{--                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
            {{--                <span class="sr-only">Next</span>--}}
            {{--            </a>--}}
            {{--        </div>--}}
            {{--        <div class="border border-light col-sm-12"></div>--}}
            {{--<div class="col-sm-12 col-md-6">Posted By : {{$article->user->username}}</div>--}}
            {{--<div class="col-sm-12 col-md-6">Posted on : {{$article->created_at}}</div>--}}
        </div>
    </div>


@endsection
