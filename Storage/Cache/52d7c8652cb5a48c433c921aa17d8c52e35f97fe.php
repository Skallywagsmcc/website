
<?php $__env->startSection("content"); ?>
    <form action="/profile/editor/create" method="post">
        <input type="text" name="full_name" value="<?php echo e($user->full_name); ?>">
        <hr>

        <textarea name="about">

        </textarea>
    </form>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Profile/new.blade.php ENDPATH**/ ?>