@extends("Layouts.main")
@section("title")
    Home
    @endsection
@section("content")
    <form action="/" method="post">
        {{ csrf() }}
        <button>Save</button>
    </form>
@endsection
