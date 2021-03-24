


<?php $__env->startSection("content"); ?>
        <div class="alert-dark"><?php if(isset($error)): ?>Error says : <?php echo e($error); ?><?php endif; ?></div>
        <hr>

        <form action="/account/edit/password" method="post">
            Your Old Password
            <input type="password" name="password">
            <hr>

            new password
            <input type="password" name="newpw"><br>
            <input type="password" name="confirm">
            <hr class="text-white">
            Please note that changing your password will log you out
            <button>update Password</button>
        </form>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/PasswordChange.blade.php ENDPATH**/ ?>