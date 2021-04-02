

<?php $__env->startSection("title"); ?>
    Verify : Your two factor Auth
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="row">
        <div class="col-sm-12 head">Request a Login Code</div>
        <div class="col-sm-12 text-center">
            Please click the Request Code Button below and we will send and email to your request email address ( <?php echo e($user->email); ?> )
            <br>
            Once submitted this request will last for 15 minutes, after this a new request will need to be made
        </div>
    </div>
    <div class="col-sm-12">
        <form action="<?php echo e($url->make("tfa.get")); ?>" method="post">
            <input type="hidden" readonly required name="email" value="<?php echo e($user->email); ?>">
            <button class="btn btn-block btn-primary text-white">Request Code</button>
        </form>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Tfa/index.blade.php ENDPATH**/ ?>