

<?php $__env->startSection("title"); ?>
    Members Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row">
            <?php if($members->count() == 0): ?>
                <div class="col-sm-12 head">No Members found</div>
                <div class="col-sm-12">It seems that No Members have been added to the system currently</div>
            <?php else: ?>
                <div class="col-sm-12 head">Our Members</div>
                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12.col-md-3 my-1">
                        <div class="col-sm-12 my-1">
                            <div class="col-sm-12">
                                <img src="/img/uploads/<?php echo e($member->user->Profile->image->image_name); ?>" height="200"
                                     width="200" alt="">
                            </div>
                            <div class="col-sm- text-center my-2 border border-top-1  border-primary">
                                <?php echo e($member->user->Profile->user->username); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Members/index.blade.php ENDPATH**/ ?>