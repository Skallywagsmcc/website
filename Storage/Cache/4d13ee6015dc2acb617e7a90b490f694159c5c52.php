

<?php $__env->startSection("title"); ?>
    Verify : Your two factor Auth
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="row">
        <div class="col-sm-12 head">Enter Your Code</div>
        <div class="col-sm-12 text-center">
            Please click the Request Code Button below and we will send and email to your request email address ( <?php echo e($user->email); ?> )
            <br>
            Once submitted this request will last for 15 minutes, after this a new request will need to be made
        </div>
    </div>
    <div class="col-sm-12">
        <form action="<?php echo e($url->make("tfa.save")); ?>" method="post">
            <input type="text" name="code" class="form-control my-2" value="<?php echo e($tfa->code); ?>">
            <button class="btn btn-block btn-secondary text-white">Request Code</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Tfa/code.blade.php ENDPATH**/ ?>