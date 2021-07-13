<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand d-md-none d-block">
        <img src="/img/logo.png" class='d-md-none d-show' alt="Logo">
    </div>




    <a href="#"  class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo e($url->make("homepage")); ?>">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("charters.home")); ?>">Our Charters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("articles.home")); ?>">Our Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("events.home")); ?>">Our Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("members.home")); ?>">Our Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("contact-us")); ?>">Contact us</a>
            </li>
        </ul>

        <ul class="ml-auto navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("profile.home",["usernam"=>$user->username])); ?>">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("backend.home")); ?>">My Account</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e($url->make("logout")); ?>">logout</a>
            </li>

        </ul>
    </div>

</nav>
<?php /**PATH /var/www/html/public_html/Views/Includes/Frontend/Navbar.blade.php ENDPATH**/ ?>