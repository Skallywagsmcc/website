

<?php $__env->startSection("title"); ?>
    Security : Two Factor Authentication
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="<?php echo e($url->make("security.home")); ?>">Back to
                    Security Home</a></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Your TFA Settings</div>
        </div>
    </div>

    <div class="container my-1">
        <div class="row box">
            <div class="col-sm-12 px-0 px-md-2">
                Currently Two Factor authentication Manager is unavailable Please continue to check back for futher
                updates
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/UserCp/Account/Security/tfa.blade.php ENDPATH**/ ?>