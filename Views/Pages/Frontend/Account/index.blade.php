@extends("Layouts.main")


@section("content")
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            @include("Includes.AccountNav")
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Your Profile
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">First name : {{$user->Profile->first_name}}</div>
                <div class="col-sm-12 col-md-6">Last name : {{$user->Profile->last_name}}</div>
            </div>
            <div class="row">
                <div class="col-sm-12">Username {{$user->username}}</div>
            </div>
            <div class="row">
                <div class="col-sm-12">Email Address {{$user->email}}</div>
            </div>
            <div class="row">
                <div class="col-sm-12">Date of birth :  {{$user->Profile->dob}}}</div>
            </div>
        </div>
    </div>

    {{--    the profile information will show down here.--}}

@endsection