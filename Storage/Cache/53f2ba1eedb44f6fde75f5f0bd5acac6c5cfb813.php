


<?php $__env->startSection("title"); ?>
    Image Manager
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <?php if($image->count() == 1): ?>
        <?php
        $image = $image->first();
        ?>

        <?php echo e($image->id); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center"><a href="<?php echo e($url->make("auth.admin.images.home")); ?>" class="d-block py-2">Back
                    to Images Home </a></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Manage image <?php echo e($image->title); ?></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 p-2 d-md-flex justify-content-md-center">
                <img src="/img/uploads/<?php echo e($image->name); ?>" class="img-fluid" alt="<?php echo e($image->title); ?>">
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 p-2 text-center">
                <a class="d-block" href="<?php echo e($url->make("auth.admin.images.delete",["user_id"=>base64_encode($image->user->id),"id"=>base64_encode($image->id)])); ?>">Delete
                    Image</a>
            </div>
        </div>
    </div>
    
    <?php else: ?>
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-md-left text-center pl-md-1">No Image found</div>
            </div>
        </div>
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 p-2 text-center">
                    No image has been found with that id <br><br> <a class="d-block" href="<?php echo e($url->make("auth.admin.images.home")); ?>"> Return to image
                        list</a>
                </div>
            </div>
        </div
        <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Images/manage.blade.php ENDPATH**/ ?>