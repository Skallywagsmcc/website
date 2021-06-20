@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
    <div class="container">
        @if(\App\Http\Libraries\Authentication\Auth::id() == $user->id)
        <div class="col-sm-12 text-right pr-5"><h5><a href="#">Edit Profile</a></h5></div>
        @endif
        <div class="row mt-3">
            <div class="col-sm-12 d-flex justify-content-center">
                <img src="/img/uploads/{{$user->Profile->Image->image_name}}" class="profile_pic m-2" height="150" width="150" alt=" {{$user->username}} Profile Image">
{{--                <img src="/img/logo.png" class="profile_pic m-2" height="150" width="150" alt=" {{$user->username}} Profile Image">--}}
            </div>
        </div>
        <div class="row event text-center px-0">
            <div class="col-sm-12 d-block d-md-none"><h2>Profile Menu</h2></div>
                <div class="col-sm-12 col-md-4 py-2"><a href="">About {{$user->Profile->first_name}}</a></div>
                <div class="col-sm-12 col-md-4 py-2">{{$user->Profile->first_name}}'s Gallery</div>
                <div class="col-sm-12 col-md-4 py-2">Contact Me</div>
        </div>
        {{--
                </div>
            </div>
        {{--    <div class="row mt-1">--}}
        {{--        <div class="col-md-4">--}}
        {{--            <div class="head">{{$user->Profile->first_name}} {{$user->Profile->last_name }}</div>--}}
        {{--            <div class="text-center">--}}
        {{--               <div>@if(\App\Http\Libraries\Authentication\Auth::id() == $user->id) <a href="/account/edit/picture">Upload a profile picture</a> @endif</div>--}}
        {{--            </div>--}}
        {{--            <div class="text-center">--}}
        {{--                @include("Includes.ProfileNav")--}}

        {{--            </div>--}}
        {{--       </div>--}}
        {{--        <div class="col-md-8">--}}
        {{--            <div class="head">About {{$user->username}}</div>--}}
        {{--            {{$user->Profile->about}}--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </div>

@endsection