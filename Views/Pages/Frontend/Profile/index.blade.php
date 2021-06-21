@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
@include("Includes.ProfileNav")
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