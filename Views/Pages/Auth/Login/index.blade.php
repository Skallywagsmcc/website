@extends("Layouts.main")
@section("content")
    <div class="alert-danger my-2 text-center">{{$errmessage}}</div>
    <form action="/auth/login" method="post">
        <input type="text" name="username" id="username" value="{{$user->username}}" placeholder="Username or email address"/><br><br>
        <input type="password" name="password" id="password"/><br><br>
        <button>Save</button>
    </form>
    @endsection