@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
@include("Includes.Frontend.ProfileNav")
    <div class="container">
        <div class="row px-1">
            <div class="col-sm-12 col-md-4 px-0 px-md-3 my-3 mx-3 mx-md-0">
                <div class="col-sm-12 head lb2">Basic Information</div>
                <div class="col-sm-12 text-center text-md-right lb2"> Username : {{$user->username}}</div>
                <div class="col-sm-12 text-center text-md-right lb2"> Full Name : {{$user->Profile->first_name}} {{$user->Profile->last_name}}</div>
                <div class="col-sm-12 text-center text-md-right lb2"> Email Address : {{$user->email}}</div>
            </div>
            <div class="col-sm-12 col-md-8 px-0 px-md-3 my-3 mx-3 mx-md-0">
                <div class="col-sm-12 head lb2">About {{ucwords($user->Profile->first_name)}}</div>
                <div class="col-sm-12 px-0 lb2">
                    {{$user->Profile->about}}
                </div>
            </div>
        </div>
    </div>


@endsection
