@extends("Layouts.main")

@section("content")

    @foreach($Required as $require)
        the values :: {{$require}} is missing <br>
    @endforeach
    <div class="message"></div>

<form action="/auth/reset-password/update" method="post">
    <input type="text" name="id" value="{{$id}}"><br><br>
    <input type="text" name="hex" value="{{$hex}}"><br><br>

    <input type="password" name="password"> <br><br>
    <input type="password" name="confirm"><br><br>
    <button>Save</button>
</form>
    @endsection