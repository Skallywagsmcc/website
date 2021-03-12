@extends("Layouts.main")

@section("title")
    @endsection

@section("content")
    <form action="/admin/users/new" method="post">
        <input type="text" name="email" value="{{$user->email}}" placeholder="Email">
        <input type="text" name="username" value="{{$user->username}}" placeholder="Username">
        <input type="text" name="password">
        <button>Create user and send email</button>
    </form>
@endsection