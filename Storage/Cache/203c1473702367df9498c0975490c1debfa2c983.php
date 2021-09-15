

<?php $__env->startSection("title"); ?>
Account manager : Home
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>


<div class="container my-3">
    <div class="row">
        <div class="col-sm-12 col-md-3 px-0 px-md-2 my-1 ">
            <div class="col-sm-12 px-0 box ">
                <div class="head py-2">Menu</div>
                    <div><a class="py-2 d-block text-center" href="<?php echo e($url->make("account.basic.home")); ?>">Update Basic information</a></div>
                    <div><a class="py-2 d-block text-center" href="<?php echo e($url->make("account.about.home")); ?>">Update About me</a></div>
                    <div><a class="py-2 d-block text-center"  href="<?php echo e($url->make("account.settings.home")); ?>">Account Settings</a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 px-0 px-md-2 my-1">
            <div class="col-sm-12 px-0 px-0 box">
                <div class="head py-2">Welcome to the site</div>
                <div class="px-1 text-center text-md-left">
                    Welcome to your User Control panel, this page is just a splash screen to give you a break down of  your profile
                    and any information you have provided.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/UserCp/Account/Profile/index.blade.php ENDPATH**/ ?>