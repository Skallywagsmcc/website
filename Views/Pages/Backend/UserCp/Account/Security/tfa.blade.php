@extends("Layouts.backend")

@section("title")
    Security : Two Factor Authentication
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("security.home")}}">Back to
                    Security Home</a></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Your TFA Settings</div>
        </div>
    </div>

    <div class="container my-1">
        <div class="row box">
            <div class="col-sm-12 px-0 px-md-2">
                Currently Two Factor authentication Manager is unavailable Please continue to check back for futher
                updates
            </div>
        </div>
    </div>
@endsection