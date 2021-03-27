@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}

    <div class="row mt-1">
        <div class="col-md-4">
            <div class="head">{{$user->Profile->first_name}} {{$user->Profile->last_name }}</div>
            <div class="text-center">
                <img src="/img/uploads/{{$user->Profile->Image->image_name}}" class="img-thumbnail m-2" height="300" width="100%" alt="">
                <div>@if(\App\Http\Libraries\Authentication\Auth::id() == $user->id) <a href="/account/edit/picture">Upload a profile picture</a> @endif</div>
            </div>
           <div class="text-center">
                @include("Includes.ProfileNav")

            </div>


            <a href='{{$url->make('gallery.home', ['username' => $user->username ]) }}'>View link</a>
        </div>
        <div class="col-md-8">
            <div class="head">About {{$user->username}}</div>
            {{$user->Profile->about}}
        </div>
    </div>
@endsection