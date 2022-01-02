


<?php $__env->startSection("title"); ?>
    Image Manager
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="<?php echo e($url->make("auth.admin.home")); ?>">Back to admin home</a>
            </div>
        </div>
    </div>

    <div class="container">

        <form action="<?php echo e($url->make("auth.admin.images.search")); ?>" class="tld-form">
            <div class="form-row">
                <div class="col-sm-12 col-md-9 my-3">
                    <input type="search" class="form-control tld-input" name="keyword" placeholder="Search for a user">
                </div>
                <div class="col-sm-12 col-md-3 my-3 ">
                    <button class="btn btn-block btn-dark">Search</button>
                </div>
            </div>
        </form>
    </div>


    <div class="container">

        
        <div class="row">
            <div class="col-sm-12 head">Manage Uploaded Images  </div>
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-md-4 my-2">
                    <div class="col-sm-12 border border-primary py-1">
                        <img src="/img/uploads/<?php echo e($image->name); ?>" class="img-fluid" alt="<?php echo e($image->name); ?>-<?php echo e($image->id); ?>">
                    </div>
                    <div class="col-sm-12 border border-primary my-1"><a href="<?php echo e($url->make("admin.images.manage",["username"=>$image->user->username,"id"=>base64_encode($image->id)])); ?>">Manage Images</a></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Images/index.blade.php ENDPATH**/ ?>