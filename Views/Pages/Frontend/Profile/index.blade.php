@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}

    <div class="row mt-1">
        <div class="col-md-4">
            <div class="head">{{$user->Profile->first_name}} {{$user->Profile->last_name }}</div>
            <div class="text-center">
                <img src="/img/logo.png" class="img-thumbnail m-2" height="200" width="200" alt="">
            </div>
           <div class="text-center">
                @include("Includes.ProfileNav")

            </div>

        </div>
        <div class="col-md-8">
            <div class="head">About {{$user->username}}</div>
            {{$user->Profile->about}}
        </div>
    </div>
@endsection