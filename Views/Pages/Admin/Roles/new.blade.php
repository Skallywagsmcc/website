@extends("Layouts.main")

@section("title")
    Admin Panel : Create new Role
    @endsection

@section("content")
    {{$message}}
    <form action="/admin/roles/new" method="post">
        <input type="text" name="title" value="{{$blog->title}}">
        <button>Save</button>
    </form>
@endsection
