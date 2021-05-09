@extends("Layouts.main")

@section("content")
    <h2>Registration : Create Your Password</h2>
    <form action="/auth/register/validate" method="post">
        <input type="text" value="{{$id}}" name="id">
        <input type="password" name="password"><br><br>
        <input type="password" name="confirm"><br><br>
        <button>Save</button>
    </form>
    @endsection