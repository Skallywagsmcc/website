

<?php $__env->startSection("title"); ?>
    Charters : <?php echo e($chaters->title); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-lg-right pl-lg-right-3"><a class="d-block py-2"
                                                                              href="<?php echo e($url->make("charters.home")); ?>">Back
                    to charters</a></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 lb1">
            <h2 class="col-sm-12 text-center head py-2 text-lg-left pl-lg-2">Our Charters</h2>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-xs-12 px-0" id="cover_image">
                    <img src="/img/uploads/covers/<?php echo e($charter->CoverImage->name); ?>"
                         alt=" <?php echo e($user->username); ?> Profile Image">
                </div>

                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/<?php echo e($charter->image->name); ?>"
                                                                class="profile_pic justify-content-center"
                                                                height="150" width="150"
                                                                alt=" <?php echo e($charter->image->title); ?>"></div>
            </div>

            <div class="col-sm-12" id="profile_name"><?php echo e($charter->title); ?> </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-lg-0">
            <div class="col-sm-12 p-0">
                <div class="row mx-0">
                    <div class="col-sm-12 head my-2 lb1 ">About the charter</div>
                    <div class="col-sm-12 py-2 lb2">
                        <?php echo e($charter->content); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-lg-0">
            <div class="col-sm-12 col-lg-6 text-center py-2 lb2 my-2 my-lg-0">
                <?php if($charter->updated_at > $charter->created_at): ?>
                    Updated: <?php echo e(date("d/m/Y : H:i",strtotime($charter->updated_at))); ?>

                <?php else: ?>
                    Added: <?php echo e(date("d/m/Y : H:i",strtotime($charter->created_at))); ?>

                <?php endif; ?>


            </div>
            <div class="col-sm-12 col-lg-6 my-2 my-lg-0 lb2 py-2 text-center">By:
                <a href="<?php echo e($url->make("profile.view",["username"=>$charter->user->username])); ?>"><?php echo e($charter->user->username); ?></a>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Charters/view.blade.php ENDPATH**/ ?>