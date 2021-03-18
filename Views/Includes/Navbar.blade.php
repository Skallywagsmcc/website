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
                <?php

                use App\Http\Libraries\Authentication\Auth;if (isset($_COOKIE['id']) || isset($_SESSION['id'])) {
                    echo "<a href='/profile/" . Auth::getusername() . "'>" . Auth::getusername() . "</a>";
                    echo " | ";
                    echo "<a href='/auth/logout'>Logout</a>";
                } else {
                    echo "<a href='/auth/login'>Login</a>";
                }


                ?>
            </li>
        </ul>
    </div>
</nav>