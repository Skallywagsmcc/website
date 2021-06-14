
<?php $__env->startSection("content"); ?>

    <style type="text/css">
        #login {
            border: solid 5px red;
        }
    </style>

    
    
    
    
    
    
    
    
    
    
    
    
    

    <div class="row h-100">
        <div class="col-sm-12 d-flex my-auto justify-content-center">
            <div class="w-25 d-md-block d-none">
                <?php echo $__env->make("Includes.login", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div  class="w-75 d-md-none d-block">
                <?php echo $__env->make("Includes.login", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Auth", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Login/index.blade.php ENDPATH**/ ?>