


<?php $__env->startSection("content"); ?>
    
    <?php echo $__env->make("Includes.Frontend.ProfileNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 head mx-3 mx-md-0">Gallery</div>
            <?php if($count >= 1): ?>
                <?php $__currentLoopData = $user->images()->where("nvtug",0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 my-2 col-md-4 px sm-1">
                        <div class="col-sm-12 text-center">
                            <img class="p-0  my-2" src="/img/uploads/<?php echo e($gallery->name); ?>"  height="200" alt="<?php echo e($gallery->name); ?>">
                        </div>
                        <div class="col-sm-12 text-center"><a
                                    href="<?php echo e($url->make("profile.gallery.view",["username"=>$user->username,"id"=>base64_encode($gallery->id)])); ?>">View
                                image</a></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-sm-12 text-center"><h3>Sorry! it seems that no images have been uploaded by this
                        user</h3></div>
            <?php endif; ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Profile/gallery.blade.php ENDPATH**/ ?>