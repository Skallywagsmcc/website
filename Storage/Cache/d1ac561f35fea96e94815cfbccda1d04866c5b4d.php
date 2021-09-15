

<?php $__env->startSection("title"); ?>
    Admin panel Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="row col-sm-12 head">Update Account Settings</div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12"><?php if(isset($error)): ?><?php echo e($error); ?><?php endif; ?></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row col-sm-12 py-2">
            <form action="<?php echo e($url->make("auth.admin.settings.store")); ?>" method="post">
                <?php echo e(csrf()); ?>


                Email Address   : <input type="text" name="email" value="<?php echo e($settings->contact_email); ?>"><br>
                Maintainence Mode : <select name="maintainence_status" id="">

                    Current Selection : <?php if($settings->maintainence_status == 1): ?>
                        <option value="1">Maintainence Mode off</option>
                    <?php else: ?>
                        <option value="0">Maintainence Mode on</option>
                        <?php endif; ?>
                    <option value="0">Turn on Maintainence Mode</option>
                    <option value="1">Turn off Maintainence Mode</option>
                </select>
                <label for="password"> Your Password (required)</label><br>
                <input type="password" name="password">

                <button class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/settings.blade.php ENDPATH**/ ?>