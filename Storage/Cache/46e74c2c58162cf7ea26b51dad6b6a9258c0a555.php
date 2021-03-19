

<?php $__env->startSection("title"); ?>
    Error Page
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php if(isset($error)): ?>
        An Error Occurred : <?php echo e($error); ?>

        <br>
        <a href="<?php echo e($_SERVER['HTTP_REFERER']); ?>">Go Back to the previous page</a>
    <?php endif; ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/errors.blade.php ENDPATH**/ ?>