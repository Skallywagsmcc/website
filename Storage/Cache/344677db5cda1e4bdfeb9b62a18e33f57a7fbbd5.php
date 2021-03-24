

<?php $__env->startSection("title"); ?>
    Image found
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Includes.ProfileNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(isset($error)): ?>
        <?php echo e($error); ?>

    <?php endif; ?>


    <?php if($count == 0): ?>
        no page found Click this link here
    <?php else: ?>
        <div class="text-center">
            <img src="/img/uploads/<?php echo e($image->image_name); ?>" height="400" width="400"
                 alt="<?php echo e($image->image_name); ?>">

            <?php echo e($image->description); ?>

            <?php if($image->user->id == \App\Http\Libraries\Authentication\Auth::id()): ?>
                <a href="/profile/<?php echo e($image->user->username); ?>/gallery/image/delete/<?php echo e(base64_encode($image->id)); ?>">Delete
                    image</a>
            <?php endif; ?>
        </div>




    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Profile/Gallery/view.blade.php ENDPATH**/ ?>