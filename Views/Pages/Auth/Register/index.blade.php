@extends("Layouts.main")
@section("content")

    <h2>Message : @isset($errmessage){{ $errmessage }}@endisset</h2>
        @if($requirments == true)
            The Password Requirments are as follwes
            1  Upper case letter <br>
            1 lower case letter <br>
            1 number <br>
        @endif

        <form id="register" action="/auth/register" method="post">
            <input type="text" name="email" id="email" value="{{$user->email}}" placeholder="email address"><br><br>
            <input type="password" name="password" id="password"><br><br>
            <input type="password" name="confirm" id="confirm"><br><br>
            <button id="save">Register Account</button>
        </form>
    </div>

@endsection("content")