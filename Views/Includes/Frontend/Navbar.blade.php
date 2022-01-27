
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand d-md-none d-block">
        <img src="/img/logo.png" class='d-md-none d-show' alt="Logo">
    </div>
{{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"--}}
{{--            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--        Menu--}}
{{--    </button>--}}

        <a href="#"  class="navbar-toggler  ml-auto" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
           aria-expanded="false" aria-label="Toggle navigation">Menu</a>



    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">
{{--            Predefined--}}
            <li class="nav-item active">
                <a class="nav-link" href="{{$url->make("homepage")}}">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("charters.home")}}">Our Charters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("articles.home")}}">Our Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("events.home")}}">Our Events</a>
            </li>
            <li class="nav-item">
{{--                <a class="nav-link" href="{{$url->make("members.home")}}">Our MembersController</a>--}}
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("contact-us")}}">Contact us</a>
            </li>
        </ul>

        <ul class="ml-auto navbar-nav">

            @if(Auth())
                <li class="nav-item">
                    <a class="nav-link" href="{{$url->make("profile.view",["username"=>$user->username])}}">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{$url->make("account.home")}}">My Account</a>
                </li>
            @if(User()->is_admin == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{$url->make("auth.admin.home")}}">Admin Panel</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{$url->make("logout")}}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{$url->make("login")}}">Login</a>
                </li>
            @endif

        </ul>
    </div>

</nav>
