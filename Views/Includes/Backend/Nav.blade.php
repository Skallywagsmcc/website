<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png" alt="Logo">
    </div>
    <a href="#" class="navbar-toggler d-block d-md-none" data-toggle="collapse" data-target="#navbarNav"
       aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse px-0" id="navbarNav">
        <ul class="ml-auto navbar-nav">
            {{--All these pages need to link to a homepage/index page for each section--}}
            <li class="nav-item">
                <a href="{{$url->make("account.home")}}" class="nav-link">Account Manager</a>
            </li>
            <li class="nav-item ">
                <a href="{{$url->make("security.home")}}" class="nav-link">Account Security</a>
            </li>
            <li class="nav-item ">
                <a href="{{$url->make("images.gallery.home")}}" class="nav-link">Image Manager</a>
            </li>
            @if(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->is_admin === 1)
                <li class="nav-item mr-md-5">
                    <a href="{{$url->make("admin.home")}}" class="nav-link">Admin Manager</a>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{$url->make("homepage")}}" class="nav-link">Main Site</a>
            </li>
            <li class="nav-item">
                <a href="{{$url->make("logout")}}" class="nav-link">Logout</a>
            </li>

        </ul>
    </div>

</nav>