

@if(\App\Http\Libraries\Authentication\Auth::id() == $user->id)
    <hr>
    <div><a href="/{{$user->username}}/tools/manage/profile">Edit Profile</a></div>
    <div><a href="/{{$user->username}}/tools/manage/articles">Manage my Articles</a></div>
    <div><a href="/{{$user->username}}/tools/manage/account">My Account</a></div>
    <div><a href="/{{$user->username}}/tools/moderate">Administrator Tools</a></div>
@endif
