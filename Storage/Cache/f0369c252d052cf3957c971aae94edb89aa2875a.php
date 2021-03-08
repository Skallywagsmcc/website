

<?php $__env->startSection("title"); ?>
    Admin Panel New Article
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
<h6>Create a new Article</h6>
<?php echo e($message); ?>

<?php if(isset($values)): ?>
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    Missing <?php echo e($value); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    <form action="/admin/blog/new" method="post">

        <input type="text" name="title" value="<?php echo e($blog->title); ?>" placeholder="Article title">
        <textarea name="content" id="" cols="30" rows="10"></textarea>
        <button>Save</button>
    </form>

    here we will create a new article.
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Blogs/NewBlog.blade.php ENDPATH**/ ?>