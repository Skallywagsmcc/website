<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png" alt="Logo">
    </div>
    <a href="#" class="navbar-toggler d-block d-lg-none" data-toggle="collapse" data-target="#navbarNav"
       aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse px-0" id="navbarNav">
        <ul class="ml-auto navbar-nav">
            
            <li class="nav-item">
                <a href="<?php echo e($url->make("backend.home")); ?>" class="nav-link">Dasboard Home</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e($url->make("account.home")); ?>" class="nav-link">Account Manager</a>
            </li>
            <li class="nav-item ">
                <a href="<?php echo e($url->make("security.home")); ?>" class="nav-link">Account Security</a>
            </li>
            <li class="nav-item ">
                <a href="<?php echo e($url->make("images.gallery.home")); ?>" class="nav-link">Image Manager</a>
            </li>

            <li class="nav-item ml-md-5">
                <a href="<?php echo e($url->make("homepage")); ?>" class="nav-link">Main Site</a>
            </li>
            <?php if(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->is_admin == 1): ?>
                <li class="nav-item ">
                    <a href="<?php echo e($url->make("auth.admin.home")); ?>" class="nav-link">Admin Manager</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="<?php echo e($url->make("logout")); ?>" class="nav-link">Logout</a>
            </li>

        </ul>
    </div>

</nav><?php /**PATH /var/www/html/public_html/Views/Includes/Backend/Nav.blade.php ENDPATH**/ ?>