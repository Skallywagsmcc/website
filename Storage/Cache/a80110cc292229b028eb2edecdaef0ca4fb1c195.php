

<?php $__env->startSection("title"); ?>
    Events Manager : Homepage
<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>


    <?php if(isset($message)): ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col sm-12 p-2 text-center"><?php echo e($message); ?></div>
            </div>
        </div>
    <?php endif; ?>



    
    <div class="container my-2">
        <div class="row ">
            <div class="col-sm-12 col-md-6 my-2 my-md-0 text-center text-md-left pl-md-1">
                <a class="py-2 d-block" href="<?php echo e($url->make("auth.admin.home")); ?>"> << Back to admin home</a>
            </div>
            <div class="col-sm-12 col-md-6 new py-2 text-md-right text-center"><a
                        href="<?php echo e($url->make("auth.admin.events.new")); ?>" class=" text-md-right text-center pr-md-1 p-2">Add
                    New Event</a></div>
        </div>
    </div>

    <div class="container d-none d-md-block head box">

        <div class="row text-center head">
            <div class="col-sm-12 col-md-6  text-center">Event Title</div>
            <div class="col-sm-12 col-md-4  text-center">Options</div>
            <div class="col-sm-12 col-md-2  text-center">delete</div>
        </div>
    </div>
    <?php if($events->count() >= 1): ?>
    <form action="<?php echo e($url->make("auth.admin.events.delete")); ?>" method="post" class="tld-form">
        <div class="container">
            <?php echo e(csrf()); ?>

        </div>

        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container my-2 my-md-0">
                <div class="row text-center my-md-0 box withhover title">
                    <div class="col-sm-12 col-md-6 title py-2"><?php echo e($event->title); ?></div>
                    <div class="col-sm-12 col-md-2 py-2"><a
                                href="<?php echo e($url->make("auth.admin.events.edit",["id"=>base64_encode($event->id)])); ?>">edit this
                            event</a></div>
                    <div class="col-sm-12 col-md-2 py-2 text-center">
                        <input type="checkbox" name="id[]" value="<?php echo e($event->id); ?>">
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12"><input type="password" name="password" class="form-control tld-input" placeholder="Please enter your password"></div>
                </div>
            </div>
            <div class="container">
                <div class="row box">
                    <div class="col-sm-12 py-2"><button class="btn btn-block tld-button">Delete selected</button></div>
                </div>
            </div>
    </form>
    <?php else: ?>
        <div class="container my-2">
            <div class="box row">
                <div class="col-sm-12 text-center py-2">No Results found</div>
            </div>
        </div>
    <?php endif; ?>




<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Events/index.blade.php ENDPATH**/ ?>