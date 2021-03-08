

<?php $__env->startSection("title"); ?>
    Admin Panel : Create new Role
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo e($message); ?>

    <form action="/admin/roles/new" method="post">
        <input type="text" name="title" value="<?php echo e($blog->title); ?>">
        <button>Save</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Roles/new.blade.php ENDPATH**/ ?>