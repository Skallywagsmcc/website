
<?php $__env->startSection("title"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <form action="<?php echo e($url->make("admin.category.store")); ?>" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="title" value="<?php echo e($category->title); ?>">
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Categories/create.blade.php ENDPATH**/ ?>