@extends("Layouts.main")
@section("title")
    Skallywagsmcc Articles
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center my-2">
                {!! $links !!}
            </div>
            <div class="col-sm-12 col-md-2 text-center my-1">
                <div class="col-sm-12 head">By Year</div>
            @foreach($years as $year)
                    <a href="{{$url->make("articles.year",["year"=>\Carbon\Carbon::parse($year->created_at)->format("Y")])}}">  {{\Carbon\Carbon::parse($year->created_at)->format("Y")}}</a>
                    <br>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-10">
                @if($count >= 1)
{{--                    {{ redirect($url->make("articles.view",["slug"=>$articles->first()->slug]))}}--}}
{{--                @elseif($count > 1)--}}
                    @foreach($articles as $article)
                        <div class="row my-1">
                            <div class="col-md-12 head">
                                {{$article->title}}
                            </div>
                            <div class="col-md-12">
                                {!! nl2br($article->content) !!}
                                <hr>
                            </div>
                            <div class="col-md-6">Article created {{date("d/m/Y H:i:s",strtotime($article->created_at))}}</div>
                            <div class="col-md-6 text-right"><a href="{{$url->make("articles.view",["slug"=>$article->slug])}}">View Article</a></div>
                        </div>

                    @endforeach
                @else
                    No articles found;
                @endif
            </div>
        </div>

    </div>

@endsection
