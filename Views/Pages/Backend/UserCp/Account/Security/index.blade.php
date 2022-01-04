@extends("Layouts.main")

@section("title")
    Security Home
@endsection

@section("content")

    <div class="container my-2">
        <div class="row box">

            <div class="col-sm-12 col-md-4 py-2 text-center">
                <a  class="py-2 d-block" href="{{$url->make("security.email.home")}}">Update Email Address</a>
            </div>

            <div class="col-sm-12 col-md-4 py-2 text-center">
                <a class="py-2 d-block" href="{{$url->make("security.password.home")}}">Update Password</a>
            </div>

            <div class="col-sm-12 col-md-4 py-2 text-center">
                <a class="py-2 d-block disabled" href="{{$url->make("security.tfa.home")}}">Manage Two Factor Authentication</a>
            </div>

        </div>
    </div>
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 px-0 px-md-2 my-1">
                <div class="col-sm-12 my-2 box px-0">
                    <div class="py-2 text-center text-md-left pl-md-1 head">Welcome to the site</div>
                </div>
                <div class="col-sm-12 px-0 px-md-2 box">
                        Welcome to your User Control panel, this page is just a splash screen to give you a break down of  your profile
                        and any information you have provided.
                </div>
            </div>
        </div>
    </div>
@endsection