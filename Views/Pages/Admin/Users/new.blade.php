@extends("Layouts.main")

@section("title")
    @endsection

@section("content")
    <form action="/admin/users/new" method="post">
        <input type="text" name="email" value="{{$user->email}}">
        <input type="text" name="username" value="{{$user->username}}">
        <button>Create user and send email</button>
    </form>
@endsection