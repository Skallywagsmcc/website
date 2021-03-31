

<?php $__env->startSection("title"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="row">
        <div class="col-md-12 head">Edit User Information for
            : <?php echo e($user->Profile->first_name); ?> <?php echo e($user->Profile->last_name); ?></div>
    </div>
    <form action="<?php echo e($url->make("admin.users.update")); ?>" method="post">
<?php echo e(csrf()); ?>

        <label for="last_name">Username (this CANNOT be Changed): </label>
        <input type="text" class="form-control-plaintext text-white" readonly name="username"
               value="<?php echo e($user->username); ?>">
        <div class="form-group text-right">
            <input type="hidden" class="id" name="id" value="<?php echo e($user->id); ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First name : </label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo e($user->Profile->first_name); ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last name : </label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo e($user->Profile->last_name); ?>">
                </div>
            </div>
            <hr class="bg-light">
            <label for="email">Email Address : </label>
            <input type="text" class="form-control" name="email" value="<?php echo e($user->email); ?>">
            <br>
            <button class="btn btn-primary">Update User Details</button>
        </div>
        <div class="col-sm-12 head">User Preferences</div>
        <?php if($user->settings_count == 1): ?>
            <div class="form-row">
                <div class="col-md-6 text-right">
                    <label for="two_factor_auth" class="form-check-label">Use Two Factor Authentication</label>
                </div>
                <div class="col-md-6 py-2">
                    <input type="checkbox" name="two_factor_auth"
                           <?php if($user->settings->two_factor_auth == 1): ?> checked="checked"
                           <?php endif; ?> class="form-check">
                </div>
            </div>

            <div class="form-row ">
                <div class="col-md-6 text-right">
                    <label for="two_factor_auth" class="form-check-label">Email marketing</label>
                </div>
                <div class="col-md-6 py-2">
                    <input type="checkbox" name="two_factor_auth" class="form-check">
                </div>
            </div>
        <?php else: ?>
            no settings table found
        <?php endif; ?>


    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Users/edit.blade.php ENDPATH**/ ?>