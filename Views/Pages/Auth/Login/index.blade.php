@extends("Layouts.Auth")
@section("content")

    <style type="text/css">
        #login {
            border: solid 5px red;
        }
    </style>
    <div class="alert-danger my-2 text-center">
        @isset($error)
            @if($error == "required")
                <h2>Please check the required fields</h2>
                @foreach($validate::$values as $value)
                    {{$value}}  Missing <br>
                @endforeach
            @else
                <h2>An Error Occurred</h2>
                {{$error}}
            @endif
        @endisset
    </div>
    <div class="row h-100 mx-0 px-0">
        <div class="col-sm-12 d-flex my-auto justify-content-center">
    @if($mode->count() == 1 && $mode->first()->lock_submissions == 1)

        <div class="row">
            <div class="col-sm-12 lb3 head">Login Has Been disabled</div>
            <div class="col-sm-12 text-center">The Administrator of this site has Disabled Logins for the time being Please try again later</div>
        </div>
    @else
                <div class="w-25 d-md-block d-none">
                    @include("Includes.Frontend.login")
                </div>

                <div  class="w-75 d-md-none d-block">
                    @include("Includes.Frontend.login")
                </div>
    @endif
        </div>
    </div>
@endsection