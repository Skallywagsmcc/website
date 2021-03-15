@extends("Layouts.main")
@section("title")
    Skallywagsmcc Article {{ $article->slug }}
@endsection

@section("content")

    the article  is : {{$article->slug}} posted by : {{$article->user->username}}

@endsection
