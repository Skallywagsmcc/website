@extends("Layouts.main")


@section("title")
    Admin Panel
@endsection

@section("content")
    Welcome to the Admin panel
    <a href="{{$url->make("admin.users.home")}}">Admin  users Panel</a> <br>
    <a href="{{$url->make("admin.articles.home")}}">Admin articles Panel</a> <br>
    <a href="{{$url->make("admin.charters.home")}}">Admin charters Panel</a> <br>
    <a href="{{$url->make("admin.settings")}}">Admin Settings Panel</a> <br>
    <a href="{{$url->make("admin.images.home")}}">Admin Images Panel</a> <br>
    <a href="{{$url->make("admin.images.featured.index")}}">Admin Featured images Panel</a> <br>
    @endsection