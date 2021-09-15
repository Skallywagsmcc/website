
<?php $__env->startSection("content"); ?>

    <style type="text/css">
        #login {
            border: solid 5px red;
        }
    </style>

            <div class="alert-danger my-2 text-center">
                <?php if(isset($error)): ?>
                    <?php if($error == "required"): ?>
                        <h2>Please check the required fields</h2>
                    <?php $__currentLoopData = $validate::$values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($value); ?>  Missing <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <h2>An Error Occurred</h2>
                        <?php echo e($error); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>

    <div class="row h-100 mx-0 px-0">
        <div class="col-sm-12 d-flex my-auto justify-content-center">
            <div class="w-25 d-md-block d-none">
                <?php echo $__env->make("Includes.Frontend.login", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div  class="w-75 d-md-none d-block">
                <?php echo $__env->make("Includes.Frontend.login", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Auth", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Login/index.blade.php ENDPATH**/ ?>