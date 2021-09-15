

<?php $__env->startSection("title"); ?>
    Charters : <?php echo e($chaters->title); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>

    <div class="container my-2">
        <div class="row lb2 base_border my-lg-3 mx-1 mx-md-0">
            <div class="col-sm-12 col-lg-3 text-center text-lg-right pr-lg-2  py-2">
                Our Newest Charter :
            </div>
            <div class="col-sm-12 col-lg-6 text-center  py-2">
                <?php echo e($latest->title); ?>

            </div>
            <div class="col-sm-12 col-lg-3 text-center  py-2">
                <a href="<?php echo e($url->make("charters.view",["slug"=>$latest->slug])); ?>" class="d-block">View Charter</a>
            </div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row">

            <?php $__currentLoopData = $charters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                    <div class="col-sm-12 mx-0 ">
                        <div class="d-flex justify-content-center">
                            <img src="/img/uploads/<?php echo e($charter->image->name); ?>" alt="" class="profile_pic m-1" height="200px" width="200px">
                        </div>
                        <div class="text-center my-2 lb2 base_border"><a href="<?php echo e($url->make("charters.view",["slug"=>$charter->slug])); ?>" class="d-block py-2"><?php echo e($charter->title); ?></a></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Charters/index.blade.php ENDPATH**/ ?>