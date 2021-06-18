<li class="nav-item dropdown">
    @if(Auth())
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="/img/uploads/{{\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->image_name}}" alt="" class="profile_pic">
            {{\App\Http\Libraries\Authentication\Auth::getusername()}} </a>
    @else
        <a href="{{$url->make("login")}}">Login</a>
    @endif
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{$url->make("profile.home",["username"=>\App\Http\Libraries\Authentication\Auth::getusername()])}}">View My Profile</a>
        <a class="dropdown-item" href="{{$url->make("account.home")}}">My Account</a>
        @if(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->is_admin == 1)
            <a class="dropdown-item" href="{{$url->make("admin.home")}}">Admin panel</a>
        @endif
        <a class="dropdown-item" href="{{$url->make("logout")}}">logout</a>
    </div>
</li>