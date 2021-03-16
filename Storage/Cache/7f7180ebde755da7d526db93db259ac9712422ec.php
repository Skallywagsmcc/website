
<?php $__env->startSection("title"); ?>
    Skallywagsmcc Article <?php echo e($article->slug); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    the article  is : <?php echo e($article->slug); ?> posted by : <?php echo e($article->user->username); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Articles/view.blade.php ENDPATH**/ ?>