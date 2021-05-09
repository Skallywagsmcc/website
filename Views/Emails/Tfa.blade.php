@extends("Layouts.main")

@section("content")
Hello {{$user->Profile->first_name}}}<br>
here is your Two Factor Authentication code {{ $code }}
<br>
Skallywags &copy;
@endsection