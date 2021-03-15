@extends("Layouts.main")
@section("title")
    Skallywagsmcc Articles
@endsection

@section("content")
    @foreach($articles as $article)
        {{$article->id}} The title of this site is <u>{{$article->title}}</u> by user {{$article->user->username}} <a
                href="/articles/view/{{$article->slug}}"> Read Article</a><br>
    @endforeach
    <hr>

    @foreach($users as $user)
        {{$user->id}} is the name of {{$user->username}} and has an article called {{$user->article->title}}<br>
    @endforeach

@endsection
