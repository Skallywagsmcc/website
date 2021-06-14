@extends("Layouts.Auth")
@section("content")

    <style type="text/css">
        #login {
            border: solid 5px red;
        }
    </style>

    {{--        <div class="alert-danger my-2 text-center">--}}
    {{--            @isset($error)--}}
    {{--                @if($error == "required")--}}
    {{--                    <h2>Please check the required fields</h2>--}}
    {{--                @foreach($validate::$values as $value)--}}
    {{--                    {{$value}}  Missing <br>--}}
    {{--                    @endforeach--}}
    {{--                @else--}}
    {{--                    <h2>An Error Occurred</h2>--}}
    {{--                    {{$error}}--}}
    {{--                @endif--}}
    {{--            @endisset--}}
    {{--        </div>--}}

    <div class="row h-100">
        <div class="col-sm-12 d-flex my-auto justify-content-center">
            <div class="w-25 d-md-block d-none">
                @include("Includes.login")
            </div>

            <div  class="w-75 d-md-none d-block">
                @include("Includes.login")
            </div>
        </div>
    </div>
@endsection