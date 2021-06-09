@extends("Layouts.main")

@section("title")
    Error Page
    @endsection

@section("content")
    @isset($error)
        An Error Occurred : {{$error}}
        <br>
        <a href="{{$_SERVER['HTTP_REFERER']}}">Go Back to the previous page</a>
    @endisset
    @endsection