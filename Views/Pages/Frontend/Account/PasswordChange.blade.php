@extends("Layouts.main")


@section("content")
    @include("Includes.AccountNav")
        <div class="alert-dark">@isset($error)Error says : {{$error}}@endisset</div>
        <hr>

        <form action="{{$url->make("account.password.store")}}" method="post">
            {{csrf()}}
            Your Old Password
            <input type="password" name="password">
            <hr>

            new password
            <input type="password" name="newpw"><br>
            <input type="password" name="confirm">
            <hr class="text-white">
            Please note that changing your password will log you out
            <button>update Password</button>
        </form>
    {{--    the profile information will show down here.--}}

@endsection