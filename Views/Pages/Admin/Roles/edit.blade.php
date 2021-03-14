@extends("Layouts.main")

@section("title")
    Admin Panel : Edit existing Role
    @endsection

@section("content")
    {{$message}}
    <form action="/admin/roles/edit" method="post">
        <input type="hidden" name="id" value="{{$role->id}}">
        <input type="text" name="title" value="{{$role->title}}">
        <button>Save</button>
    </form>
@endsection
