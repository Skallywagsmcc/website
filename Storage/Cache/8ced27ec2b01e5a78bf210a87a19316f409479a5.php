


<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Includes.AccountNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="alert-dark"><?php if(isset($error)): ?>
                Error says : <?php echo e($error); ?>

            <?php endif; ?></div>
        <hr>
        <form action="<?php echo e($url->make("account.email.store")); ?>" method="post">
            Your email
            <input type="email" name="email" value="<?php echo e($user->email); ?>">
            <hr class="text-white"> Your password
            <input type="password" name="password" value="<?php echo e($user->email); ?>">
            <button>update Password</button>
        </form>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/EmailChange.blade.php ENDPATH**/ ?>