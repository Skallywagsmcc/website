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
                @if($user->settings->display_full_name == 1)
                    <div class="col-sm-12 col-md-6">First name : {{$user->Profile->first_name}}</div>
                    <div class="col-sm-12 col-md-6">Last name : {{$user->Profile->last_name}}</div>
                @else
                    <div class="col-sm-12 col-md-12">Username Hidden from Public view</div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">Username {{$user->username}}</div>
            </div>
            <div class="row">
                @if($user->settings->display_email == 1)
                    <div class="col-sm-12">Email Address :  {{$user->email}}</div>
                @else
                    <div class="col-sm-12">Email Address :  Hidden from Public view</div>
                @endif
            </div>
            <div class="row">
                @if($user->settings->display_dob == 1)
                    <div class="col-sm-12">Date of birth : {{$dob}}</div>
                @else
                    <div class="col-sm-12">Date of birth : Hidden from Public view</div>
                @endif
            </div>
        </div>
    </div>

    {{--    the profile information will show down here.--}}

@endsection