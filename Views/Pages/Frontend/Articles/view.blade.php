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
            {{$article->content}}
        </div>
        <div class="border border-light col-sm-12"></div>
<div class="col-sm-12 col-md-6">Posted By : {{$article->user->username}}</div>
<div class="col-sm-12 col-md-6">Posted on : {{$article->created_at}}</div>
    </div>

@endsection
