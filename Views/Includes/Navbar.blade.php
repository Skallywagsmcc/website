
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand d-md-none d-block">
        <img src="/img/logo.png" class='d-md-none d-show' alt="Logo">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        Menu
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Charters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/articles">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
            </li>
        </ul>

        <ul class="ml-auto navbar-nav">
            <li class="nav-item active">
          @if(Auth())
                   <a href='/profile/{{\App\Http\Libraries\Authentication\Auth::getusername()}}'>{{\App\Http\Libraries\Authentication\Auth::getusername()}}</a>
                    |
                    <a href='/account'>My Account</a>;
                    |
                    <a href='/auth/logout'>Logout</a>
             @else
                    <a href='/auth/login'>Login</a>


@endif
            </li>
        </ul>
    </div>
</nav>