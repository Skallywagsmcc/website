


<?php $__env->startSection("content"); ?>
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            <?php echo $__env->make("Includes.AccountNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Your Profile
                </div>
            </div>
            <div class="row">
                <?php if($user->settings->display_full_name == 1): ?>
                <div class="col-sm-12 col-md-6">First name : <?php echo e($user->Profile->first_name); ?></div>
                <div class="col-sm-12 col-md-6">Last name : <?php echo e($user->Profile->last_name); ?></div>
                <?php else: ?>
                <div class="col-sm-12 col-md-12"><?php echo e($user->username); ?></div>
                    <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-sm-12">Username <?php echo e($user->username); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Email Address <?php echo e($user->email); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Date of birth :  <?php echo e($user->Profile->dob); ?></div>
            </div>
        </div>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/index.blade.php ENDPATH**/ ?>