


    <div><a href="{{$url->make("profile.home",["username"=>$user->username]) }}">{{
    $user->Profile->first_name
}}'s Profile Home</a></div>
    <div><a href="{{$url->make("gallery.home",["username"=>$user->username]) }}">{{
    $user->Profile->first_name
}}'s Gallery</a></div>
    <div><a href="{{$url->make("admin.users.home")}}">Admin users</a></div>
