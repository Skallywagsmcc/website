
<?php $__env->startSection("content"); ?>

    <div class="alert-danger my-2 text-center"><?php echo e($errmessage); ?></div>
    <?php $__currentLoopData = $Required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Missing field : <?php echo e($value); ?> <br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <form action="/auth/login" method="post">
        <input type="text" name="username" id="username" value="<?php echo e($user->username); ?>" placeholder="Username or email address"/><br><br>
        <input type="password" name="password" id="password"/><br><br>
        <a href="/auth/reset-password">Reset Password</a>
        Remember me for 7 days : <input type="checkbox" name="remember" value="1">
        <button>Save</button>
    </form>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Login/index.blade.php ENDPATH**/ ?>