@extends("Layouts.main")M

@section("content")
    <form action="{{$url->make("search.view")}}" method="get">
        <input type="text" name="keyword">
        <button>Search</button>
    </form>
@endsection