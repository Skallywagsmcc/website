

<?php $__env->startSection("title"); ?>
    Our Events
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 head my-2">Next Upcoming Event</div>
            <div class="col-sm-12 col-md-3 h-25">
                <img src="/img/uploads/<?php echo e($first->image->name); ?>" class="img-fluid" alt="<?php echo e($first->image->name); ?>-<?php echo e($first->id); ?>">
            </div>
            <div class="col-sm-12 col-md-9 d-none d-md-block">
                <?php echo e(substr($first->content,"0","100")); ?>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row info">
            <div class="col-sm-12 py-2 info text-center text-md-left col-md-6">
                <div class="title">Event : <?php echo e($first->title); ?></div>
            </div>
                <div class="col-sm-12 col-md-6 text-center text-md-right py-2"><a class="d-block" href="<?php echo e($url->make("events.view",["slug"=>$first->slug])); ?>">More info</a></div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row px-2">
            <div class="col-sm-12 col-md-3">
                <div class="head text-left my-2">Events by year</div>
                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($url->make("events.view.year",["year"=>$year->year])); ?>"><?php echo e($year->year); ?></a>we
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-sm-12 col-md-9">
                <?php if($events->count() ==0): ?>
                    <div class="head my-2">No Events Found</div>
                    <div class="info p-2">No upcoming events have been found Please check back later</div>
                    <?php else: ?>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row my-2">
                        <div class="col-sm-12 col-md-3 h-25">
                            <img src="/img/uploads/<?php echo e($event->image->name); ?>" class="img-fluid" alt="<?php echo e($event->image->name); ?>-<?php echo e($event->id); ?>">
                        </div>
                        <div class="col-sm-12 col-md-9 d-none d-md-block">
                            <?php echo e(substr($event->content,"0","100")); ?>

                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-12 col-md-9 py-md-2 text-center py-2 title text-md-left pl-md-2"><?php echo e($event->title); ?></div>
                        <div class="col-sm-12 col-md-3 text-center text-md-right py-2"><a class="d-block" href="<?php echo e($url->make("events.view",["slug"=>$event->slug])); ?>">More info</a></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 justify-content-center d-flex">
                <?php echo $links; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Events/index.blade.php ENDPATH**/ ?>