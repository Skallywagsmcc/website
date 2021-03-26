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
            <li class="nav-item dropdown">

                    <?php if(Auth()): ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="/img/uploads/<?php echo e(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->image_name); ?>" alt="" class="profile_pic">
                        <?php echo e(\App\Http\Libraries\Authentication\Auth::getusername()); ?> </a>
                    <?php else: ?>
                        <a href="/auth/login">Login</a>
                    <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">My Account</a>
                    <a class="dropdown-item" href="#">View My Profile</a>
                    <a class="dropdown-item" href="/auth/logout">logout</a>
                </div>
            </li>
        </ul>
    </div>

</nav><?php /**PATH /var/www/html/public_html/Views/Includes/Navbar.blade.php ENDPATH**/ ?>