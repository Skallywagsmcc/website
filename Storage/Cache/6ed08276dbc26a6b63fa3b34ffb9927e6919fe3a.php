

<?php $__env->startSection("title"); ?>
    <?php echo e($user->username); ?> Gallery
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <?php echo $__env->make("Includes.ProfileNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php if($count >= 1): ?>

        <?php $__currentLoopData = $user->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($images->id); ?> <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $user->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



            <a href="<?php echo e($url->make("gallery.image.view",["username"=>$user->username,"id"=>base64_encode($gallery->id)])); ?>">
                <img class="m-3" src="/img/uploads/<?php echo e($gallery->image_name); ?>" height="200" width="200"
                     alt="<?php echo e($gallery->image_name); ?>">
            </a>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>

    <form action="/profile/<?php echo e($user->username); ?>/gallery/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <textarea name="description" class="form-control"></textarea>
        <button>Upload file</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Profile/Gallery/index.blade.php ENDPATH**/ ?>