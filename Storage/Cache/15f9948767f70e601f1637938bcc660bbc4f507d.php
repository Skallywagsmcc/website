


<?php $__env->startSection("title"); ?>
    Image Manager : List Images
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container my-2 px-0">
        <div class="row">
            <div class="col-sm-12 text-center text-md-right new pr-md-1 py-1">
                <a class="p-2" href="<?php echo e($url->make("images.gallery.add")); ?>">Upload New Image</a></div>
        </div>
    </div>

    <?php if($images->count() >= 1): ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">My Images</div>
            </div>
        </div>

        <div class="container my-2 px-0">
            <div class="row">
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-4">
                        <div class="col-sm-12 box  tu text-center text-md-left pl-md-1 my-2 py-2"><?php echo e($image->title); ?></div>
                        <div class="col-sm-12 px-0">
                            <img src="/img/uploads/<?php echo e($image->name); ?>" class="img-fluid" alt="$image->id">
                        </div>
                        <div class="box py-2 text-center my-2"><a class="d-block"
                                                                  href="<?php echo e($url->make("images.gallery.update",["id"=>$image->id])); ?>">Manage
                                Image</a></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    <?php else: ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">No Images Found</div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box">
                    <div class="col-sm-12 p-2">Sorry it seems that you have not uploaded any images to the server, <a
                                href="<?php echo e($url->make("images.gallery.add")); ?>">Click here</a> to add some images
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    
    
    
    
    
    
    
    
    


<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/UserCp/ImageManager/list.blade.php ENDPATH**/ ?>