

<?php $__env->startSection("title"); ?>
    Find Event by Year
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">

        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row text-center my-2">
                <div class="col-xs-12 col-sm-12 col-md-3 my-3 my-md-0"><img src="/img/uploads/<?php echo e($event->image->name); ?>"
                                                                            class="img-thumbnail"
                                                                            alt="<?php echo e($event->image->name); ?>" height="70px">
                </div>
                <div class="col-sm-12 col-md-5"><?php echo e($event->title); ?></div>
                <div class="col-sm-12 col-md-4"><a href="<?php echo e($url->make("events.view",["slug"=>$event->slug])); ?>">View
                        Event</a></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <div class="container">
        <div class="row my-3">
            <div class="col-sm-12 d-flex justify-content-center"><?php echo $links; ?></div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Events/year.blade.php ENDPATH**/ ?>