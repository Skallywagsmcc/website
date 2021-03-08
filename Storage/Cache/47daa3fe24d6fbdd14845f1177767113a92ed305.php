;

<?php $__env->startSection("tite"); ?>
    Admin Panel : Blogs
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <h6>Blogs <a href="/admin/blog/new">Create a new Blog</a></h6>
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($blog->title); ?>  | <?php echo e($blog->slug); ?> | <a href="/admin/blog/edit/<?php echo e($blog->id); ?>">Edit</a> | <a href="/admin/blog/edit/delete/<?php echo e($blog->id); ?>">Delete</a>
        <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Blogs/index.blade.php ENDPATH**/ ?>