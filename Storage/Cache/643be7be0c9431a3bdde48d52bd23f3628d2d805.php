


<?php $__env->startSection("content"); ?>
    
    <div class="row mt-1">
        <div class="col-md-4">
            <div class="head"><?php echo e($user->Profile->first_name); ?> <?php echo e($user->Profile->last_name); ?></div>
            <div class="text-center">
                <img src="/img/logo.png" class="img-thumbnail m-2" height="200" width="200" alt="">
            </div>
           <div class="text-center">
                <?php echo $__env->make("Includes.ProfileNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>

        </div>
        <div class="col-md-8">
            <div class="head">About <?php echo e($user->username); ?></div>
            <?php echo e($user->Profile->about); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Profile/index.blade.php ENDPATH**/ ?>