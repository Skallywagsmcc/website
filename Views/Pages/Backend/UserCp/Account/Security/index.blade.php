@extends("Layouts.backend")

@section("title")
    Security Home
@endsection

@section("content")
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-md-3 px-0 px-md-2 my-1 ">

                <div class="col-sm-12 my-2 box py-2 head text-left pl-md-1">Security Navigation</div>
                <div class="col-sm-12 px-0 px-md-2 box text-center">
                        <div><a  class="py-2 d-block" href="{{$url->make("security.email.home")}}">Update Email Address</a></div>
                        <div><a class="py-2 d-block" href="{{$url->make("security.password.home")}}">Update Password</a></div>
                        <div><a class="py-2 d-block disabled" href="{{$url->make("security.tfa.home")}}">Manage Two Factor Authentication</a></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 px-0 px-md-2 my-1">
                <div class="col-sm-12 my-2 box py-2 head">Welcome to the site</div>
                <div class="col-sm-12 px-0 px-md-2 box">
                        Welcome to your User Control panel, this page is just a splash screen to give you a break down of  your profile
                        and any information you have provided.
                </div>
            </div>
        </div>
    </div>
@endsection