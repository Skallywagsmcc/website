@extends("Layouts.main")
@section("content")



    <div class="container">
        <div class="alert-danger my-2 text-center">
            @isset($error)
                @if($error == "required")
                    <h2>Please check the required fields</h2>
                @foreach($validate::$values as $value)
                    {{$value}}  Missing <br>
                    @endforeach
                @else

                    <h2>An Error Occurred</h2>
                    {{$error}}
                @endif
            @endisset
        </div>

    <form action="{{$url->make("login.store")}}" method="post">
        <input type="text" name="username" id="username" value="@isset($validate){{$validate->Post("username")}}@endisset"
               placeholder="Username or email address"/><br><br>
        <input type="password" name="password" id="password"/><br><br>
        <a href="/auth/reset-password">Reset Password</a>
        Remember me for 7 days : <input type="checkbox" name="remember" value="1">
        <button>Save</button>
    </form>
    </div>

@endsection