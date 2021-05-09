@extends("Layouts.main")
@section("title")
    Skallywagsmcc Article {{ $article->slug }}
@endsection

@section("content")
    <div class="row my-2">
        <div class="col-sm-12 head">
            {{$article->title}}
        </div>
        <div class="col-sm-12">
            {!! nl2br($article->content) !!}
        </div>


        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($images as $index => $image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}" class=" @if($index == 0) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($images as $index => $image)
                    <div class="carousel-item @if($index == 0) active @endif ">
                        <img class="d-block w-100"  height="600px" src='/img/uploads/{{$image->image_name}}'>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="border border-light col-sm-12"></div>
<div class="col-sm-12 col-md-6">Posted By : {{$article->user->username}}</div>
<div class="col-sm-12 col-md-6">Posted on : {{$article->created_at}}</div>
    </div>

@endsection
