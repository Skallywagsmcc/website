@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
@include("Includes.Frontend.ProfileNav")
    <div class="container">
        <div class="row col-sm-12">
            @if($user->Profile->is_crew == 1 )
                User is a crew Member
            @else
                Not Crew member
                @endif
        </div>

        <div class="row ">
            <div class="col-sm-12 col-md-4 px-0 px-md-3 my-3">
                <div class="col-sm-12 head">Basic Information</div>
                <div class="col-sm-12 text-center text-md-right"> Username : {{$user->username}}</div>
                <div class="col-sm-12 text-center text-md-right"> Full Name : {{$user->Profile->first_name}} {{$user->Profile->last_name}}</div>
                <div class="col-sm-12 text-center text-md-right"> Email Address : {{$user->email}}</div>
            </div>
            <div class="col-sm-12 col-md-8 px-0 px-md-3 my-3">
                <div class="col-sm-12 head">About {{ucwords($user->Profile->first_name)}}</div>
                <div class="col-sm-12 px-0">
                    {{$user->Profile->about}}
                </div>
            </div>
        </div>
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


@endsection
