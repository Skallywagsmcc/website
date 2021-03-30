@extends("Layouts.main")


@section("content")
    @include("Includes.AccountNav")
        <div class="alert-dark">@isset($error)
                Error says : {{$error}}
            @endisset</div>
        <hr>
        <form action="{{$url->make("account.email.store")}}" method="post">
            Your email
            <input type="email" name="email" value="{{$user->email}}">
            <hr class="text-white"> Your password
            <input type="password" name="password" value="{{$user->email}}">
            <button>update Password</button>
        </form>
    {{--    the profile information will show down here.--}}

@endsection