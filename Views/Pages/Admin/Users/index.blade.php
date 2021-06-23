@extends("Layouts.backend")

@section("title")
    @endsection

@section("content")


    <div class="row text-center head">
        <div class="col-md-2">Username</div>
        <div class="col-md-2">Email Address</div>
        <div class="col-md-2">Full Name</div>
        <div class="col-md-4">Account Options</div>
        <div class="col-md-2 btn-primary"><a href="/admin/users/new">New user</a></div>
    </div>

    <div class="row text-center mb-3">
        @foreach($users as $user)
            <div class="col-md-2 col-xs-12">{{$user->username}}</div>
            <div class="col-md-2 col-xs-12">{{$user->email}}</div>
            <div class="col-md-2 col-xs-12">{{$user->Profile->first_name}} {{$user->Profile->last_name}}</div>
            <div class="col-md-2 col-xs-12 "><a href="">Roles</a></div>
            <div class="col-md-2 col-xs-12 "><a href="/admin/users/edit/{{base64_encode($user->id)}}/{{base64_encode($user->username)}}">Edit Account</a></div>
        @if($user->id  == \App\Http\Libraries\Authentication\Auth::id())
            <div class="col-md-2 col-xs-12">Unavailable</div>
            @else
            <div class="col-md-2 col-xs-12"><a href="{{$url->make("admin.users.delete",["id"=>$user->id])}}">Delete Account</a></div>
            @endif
        @endforeach
        </div>

@endsection