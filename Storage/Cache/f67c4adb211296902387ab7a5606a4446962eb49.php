


<?php $__env->startSection("content"); ?>
    
<?php echo $__env->make("Includes.Frontend.ProfileNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="row px-1">
            <div class="col-sm-12 col-md-4 px-0 px-md-3 my-3 mx-3 mx-md-0">
                <div class="col-sm-12 head lb2">Basic Information</div>
                <div class="col-sm-12 text-center text-md-right lb2"> Username : <?php echo e($user->username); ?></div>
                <div class="col-sm-12 text-center text-md-right lb2"> Full Name : <?php echo e($user->Profile->first_name); ?> <?php echo e($user->Profile->last_name); ?></div>
                <div class="col-sm-12 text-center text-md-right lb2"> Email Address : <?php echo e($user->email); ?></div>
            </div>
            <div class="col-sm-12 col-md-8 px-0 px-md-3 my-3 mx-3 mx-md-0">
                <div class="col-sm-12 head lb2">About <?php echo e(ucwords($user->Profile->first_name)); ?></div>
                <div class="col-sm-12 px-0 lb2">
                    <?php echo e($user->Profile->about); ?>

                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Profile/index.blade.php ENDPATH**/ ?>