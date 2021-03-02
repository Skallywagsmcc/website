@extends("Layouts.main")
@section("content")
    <div class="alert-danger my-2 text-center">{{$errmessage}}</div>
    <form action="/auth/login" method="post">
        <input type="text" name="username" id="username" value="{{$user->username}}" placeholder="Username or email address"/><br><br>
        <input type="password" name="password" id="password"/><br><br>
        <a href="/auth/reset-password">Reset Password</a>
        Remember me for 7 days : <input type="checkbox" name="remember" value="1">
        <button>Save</button>
    </form>
    @endsection