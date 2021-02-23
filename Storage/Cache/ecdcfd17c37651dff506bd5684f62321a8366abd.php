<?php $__env->startSection("content"); ?>
    <h2>Registration : Create Your Password</h2>
    <form action="/auth/register/validate" method="post">
        <input type="text" value="<?php echo e($id); ?>" name="id">
        <input type="password" name="password"><br><br>
        <input type="password" name="confirm"><br><br>
        <button>Save</button>
    </form>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Register/Passwords.blade.php ENDPATH**/ ?>