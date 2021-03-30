<div class="row">
    <div class="col-sm-12 head">
        Menu
    </div>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.home")); ?>">Account Home</a></div>
    <!--includes firstname  lastname and date of birth-->
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.basic.home")); ?>">Edit Basic Information</a></div>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.about.home")); ?>"">Edit About me</a></div>
    <hr>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.picture.home")); ?>">Change Profile Picture</a> </div>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.email.home")); ?>">Change Email Address</a></div>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.password.home")); ?>">Change Password</a></div>
    <hr>


    <hr>
    <div class="col-sm-12"><a href="<?php echo e($url->make("account.settings.home")); ?>">User Settings</a></div>
</div>


<?php /**PATH /var/www/html/public_html/Views/Includes/AccountNav.blade.php ENDPATH**/ ?>