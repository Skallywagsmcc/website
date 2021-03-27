


    <div><a href="<?php echo e($url->make("profile.home",["username"=>$user->username])); ?>"><?php echo e($user->Profile->first_name); ?>'s Profile Home</a></div>
    <div><a href="<?php echo e($url->make("gallery.home",["username"=>$user->username])); ?>"><?php echo e($user->Profile->first_name); ?>'s Gallery</a></div>
    <div><a href="<?php echo e($url->make("admin.users.home")); ?>">Admin users</a></div>
<?php /**PATH /var/www/html/public_html/Views/Includes/ProfileNav.blade.php ENDPATH**/ ?>