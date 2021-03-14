@extends("Layouts.main")

@section("title")
    @endsection

@section("content")
    <h6>List of Roles in this site</h6> <a href="/admin/roles/new">Create a new role</a>
    @if($count == 0)
        No Roles found on the database
    @else
        @foreach($roles as $role)
            Roles list is : {{$role->title}}  | <a href="/admin/roles/edit/{{$role->id}}">Edit</a> | <a href="/admin/roles/delete/{{$role->id}}">Delete</a><br>
        @endforeach
    @endif

@endsection