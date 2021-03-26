@extends("Layouts.main")


@section("content")
        <div class="alert-dark">@isset($error)
                Error says : {{$error}}
            @endisset</div>
        <hr>
        <form action="/account/edit/email" method="post">
            Your email
            <input type="email" name="email" value="{{$user->email}}">
            <hr class="text-white"> Your password
            <input type="password" name="password" value="{{$user->email}}">
            <button>update Password</button>
        </form>
    {{--    the profile information will show down here.--}}

@endsection