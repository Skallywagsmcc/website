

@if(\App\Http\Libraries\Authentication\Auth::id() == $user->id)
    <hr>
    <div><a href="/profile/{{$user->username}}/gallery">Gallery</a></div>
@endif
