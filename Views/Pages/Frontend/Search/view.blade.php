@extends("Layouts.main")

@section("title")
    {{$_SERVER['APP_NAME']}} Search Results
@endsection

@section("content")

    @if($count == 1)
        {{ redirect($url->make("pages.view",["category"=>$category->slug,"slug"=>$page->first()->slug]))}}
    @elseif($count > 1)
        @foreach($pages as $page)
            <div class="row">
                <div class="col-md-12 head">
                    {{$page->title}}
                </div>
                <div class="col-md-12">
                    {!! nl2br($page->content) !!}
                    <hr>
                </div>
                <div class="col-md-6">Date created {{$page->created_at}}</div>
                <div class="col-md-6 text-right"><a href="{{$url->make("pages.view",["category"=>$page->category->slug,"slug"=>$page->slug])}}">View Article</a></div>
            </div>
            {!! $links !!}
        @endforeach
    @else
        No articles found;
    @endif

@endsection