
<?php $__env->startSection("content"); ?>
    <div class="alert-danger my-2 text-center"><?php echo e($errmessage); ?></div>
    <form action="/auth/login" method="post">
        <input type="text" name="username" id="username" value="<?php echo e($user->username); ?>" placeholder="Username or email address"/><br><br>
        <input type="password" name="password" id="password"/><br><br>
        <button>Save</button>
    </form>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Login/index.blade.php ENDPATH**/ ?>