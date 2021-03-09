@extends("Layouts.main")

@section("title")
    @endsection

@section("content")
    <form action="/admin/users/search" method="post">
        <input type="text" name="keyword" placeholder="enter keyword">
        <button name="save">Search</button>
    </form>
    <a href="/admin/users/new">Create new User</a><hr>
    @foreach($users as $user)

        @if(empty($user->username))
            username : {{$user->email}} |
        @else
      email : {{$user->email}} | username : {{$user->username}} |
        @endif
        <a href="/admin/users/roles/{{$user->id}}">List of roles</a>  | <a href="/admin/users/delete/{{$user->id}}">Delete user </a>
        <br>
    @endforeach
@endsection