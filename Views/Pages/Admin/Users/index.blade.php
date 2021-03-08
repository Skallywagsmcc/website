@extends("Layouts.main")

@section("title")
    @endsection

@section("content")
    @foreach($users as $user)

        @if(empty($user->username))
            username : {{$user->email}} |
        @else
      email : {{$user->email}} | username : {{$user->username}} |
        @endif
        <a href="/admin/users/roles/{{$user->id}}">List of roles</a>  | <a href="/admin/users/delete/{{$user->id}}">Delete user </a>
    @endforeach
@endsection