
<?php $__env->startSection("title"); ?>
    <?php echo e($_SERVER['TITLE']); ?> Home
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    Welcome tot the site
    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Homepage/index.blade.php ENDPATH**/ ?>