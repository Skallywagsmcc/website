@extends("Layouts.main")
@section("title")
    Skallywagsmcc Article {{ $article->slug }}
@endsection

@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-lg-right pr-lg-2 py-2">
                <a href="{{$url->make("articles.home")}}">Back to Articles</a>
            </div>
        </div>
    </div>

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
                    <div class="col-sm-12 col-lg-8 text-center text-lg-left pl-lg-2 py-2">Posted by :
                        <a href="{{$url->make("profile.view",["username"=>$article->user->username])}}">
                            {{ucfirst($article->user->Fullname($article->user_id))}}
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-4 text-center text-lg-right pr-lg-2 py-2">
                        @if($article->created_at == $article->updated_at)
                            Created : {{date("H:i",strtotime($article->created_at))}} {{date("d/m/Y",strtotime($article->created_at))}}
                        @else
                            Updated : {{date("H:i",strtotime($article->updated_at))}} {{date("d/m/Y",strtotime($article->updated_at))}}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
