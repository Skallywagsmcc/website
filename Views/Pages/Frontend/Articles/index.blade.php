@extends("Layouts.main")
@section("title")
    Skallywagsmcc Articles
@endsection

@section("content")
    @foreach($articles as $article)
        <div class="row">
            <div class="col-md-12 head">
                {{$article->title}}
            </div>
            <div class="col-md-12">
                {!! nl2br($article->content) !!}
                <hr>
            </div>
            <div class="col-md-6">Date created {{$article->created_at}}</div>
            <div class="col-md-6 text-right"><a href="/articles/view/{{$article->slug}}">View Article</a></div>
        </div>
        {{$article->id}} The title of this site is <u>{{$article->title}}</u> by user {{$article->user->username}} <a
        <hr>
        
    @endforeach
@endsection
