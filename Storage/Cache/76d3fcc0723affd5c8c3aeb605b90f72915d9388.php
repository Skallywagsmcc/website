<li class="nav-item dropdown">
    <?php if(Auth()): ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="/img/uploads/<?php echo e(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->image_name); ?>" alt="" class="profile_pic">
            <?php echo e(\App\Http\Libraries\Authentication\Auth::getusername()); ?> </a>
    <?php else: ?>
        <a href="<?php echo e($url->make("login")); ?>">Login</a>
    <?php endif; ?>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="<?php echo e($url->make("profile.home",["username"=>\App\Http\Libraries\Authentication\Auth::getusername()])); ?>">View My Profile</a>
        <a class="dropdown-item" href="<?php echo e($url->make("account.home")); ?>">My Account</a>
        <?php if(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->is_admin == 1): ?>
            <a class="dropdown-item" href="<?php echo e($url->make("admin.home")); ?>">Admin panel</a>
        <?php endif; ?>
        <a class="dropdown-item" href="<?php echo e($url->make("logout")); ?>">logout</a>
    </div>
</li><?php /**PATH /var/www/html/public_html/Views/Includes/Frontend/dropdown.blade.php ENDPATH**/ ?>