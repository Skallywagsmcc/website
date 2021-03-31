

<?php $__env->startSection("content"); ?>
    <form action="<?php echo e($url->make("search.view")); ?>" method="get">
        <input type="text" name="keyword">
        <button>Search</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Search/index.blade.php ENDPATH**/ ?>