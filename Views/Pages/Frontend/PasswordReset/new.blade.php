@extends("Layouts.main")

@section("content")

<form action="{{$url->make("password-reset.store")}}" method="post">
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="hex" value="{{$hex}}">
    Password  : <input type="password" name="password"> <br><br>
   Password Confirm :  <input type="password" name="confirm"><br><br>
    <button>Save</button>
</form>
    @endsection