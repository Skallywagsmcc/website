

<?php $__env->startSection("title"); ?>
    Charters : <?php echo e($chaters->title); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>


    <div class="container">
        <div class="row">
            <h2 class="col-sm-12 text-center head py-2">Our Charters</h2>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-xs-12 px-0" id="cover_image">
                    <img src="/img/uploads/<?php echo e($charter->CoverImage->name); ?>" alt=" <?php echo e($user->username); ?> Profile Image">
                </div>

                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/<?php echo e($charter->image->name); ?>" class="profile_pic justify-content-center"
                                                                height="150" width="150" alt=" <?php echo e($charter->image->title); ?>"></div>
            </div>

            <div class="col-sm-12" id="profile_name"><?php echo e($charter->title); ?> </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

                <div class="col-sm-12 col-md-3 text-center my-1">
                            <div class="col-sm-12 head my-1 lb1">Our Charters</div>
                            <?php $__currentLoopData = $sidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu->id == $charter->id): ?>
                                    <div class="py-1 text-center lb2" >
                                        <a href="<?php echo e($url->make("charters.view",["slug"=>$menu->slug])); ?>" class="d-block py-2"><?php echo e($menu->title); ?></a>
                                    </div>
                                <?php else: ?>
                                    <div class=" py-1 text-center lb2">
                                        <a href="<?php echo e($url->make("charters.view",["slug"=>$menu->slug])); ?>" class="d-block py-2"><?php echo e($menu->title); ?></a>
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                <div class=" col-sm-12 col-md-9 my-1">
                    <div class="col-sm-12 my-2 lb2 py-2 text-center">This Charter Was Created by : <?php echo e($charter->user->username); ?></div>
                    </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Charters/view.blade.php ENDPATH**/ ?>