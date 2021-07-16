@extends("Layouts.backend")

@section("title")
Account manager : Home
@endsection
@section("content")


<div class="container my-3">
    <div class="row">
        <div class="col-sm-12 col-md-3 px-0 px-md-2 my-1 ">
            <div class="col-sm-12 px-0 px-md-2">
                <div class="head py-2">Menu</div>
                <div class="info">
                    <div><a href="{{$url->make("account.basic.home")}}">Update Basic information</a></div>
                    <div><a href="{{$url->make("account.about.home")}}">Update About me</a></div>
                    <div><a href="{{$url->make("account.settings.home")}}">Account Settings</a></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 px-0 px-md-2 my-1">
            <div class="col-sm-12 px-0 px-md-2">
                <div class="head py-2">Welcome to the site</div>
                <div class="info px-1 text-center text-md-left">
                    Welcome to your User Control panel, this page is just a splash screen to give you a break down of  your profile
                    and any information you have provided.
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection