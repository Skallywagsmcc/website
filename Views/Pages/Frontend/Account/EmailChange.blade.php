@extends("Layouts.main")


@section("content")
    @include("Includes.AccountNav")
        <div class="alert-dark">@isset($error)
                Error says : {{$error}}
            @endisset</div>
        <hr>
        <form action="{{$url->make("account.email.store")}}" method="post">
            {{csrf()}}
            Your email
            <input type="email" name="email" value="@isset($user){{$user->email}}@endisset">
            <hr class="text-white"> Your password
            <input type="password" name="password"/>
            <button>update Password</button>
        </form>
    {{--    the profile information will show down here.--}}

@endsection