

<?php $__env->startSection("title"); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <form action="/admin/users/new" method="post">
        <input type="text" name="email" value="<?php echo e($user->email); ?>" placeholder="Email">
        <input type="text" name="username" value="<?php echo e($user->username); ?>" placeholder="Username">
        <input type="text" name="password">
        <button>Create user and send email</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Users/new.blade.php ENDPATH**/ ?>