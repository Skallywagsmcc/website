

<?php $__env->startSection("content"); ?>
    <form action="/auth/reset-password" method="post">
        <input type="email" name="email">
        <button>Send Request</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/PasswordReset/index.blade.php ENDPATH**/ ?>