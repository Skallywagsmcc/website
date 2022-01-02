
<?php $__env->startSection("title"); ?>
    List  Charters
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        <?php if(isset($error)): ?>
            <div class="bg-danger">
                <?php echo e($error); ?>

            </div>

        <?php endif; ?>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                        <a href="<?php echo e($url->make("auth.admin.home")); ?>">Back to admin home</a>
                    </div>
                </div>
            </div>

            <div class="row box border border-dark">
                <div class="col-sm-12 text-center text-md-right pr-md-2 py-2"><a href="<?php echo e($url->make("auth.admin.charters.create")); ?>">Add New Charter</a></div>
            </div>
            <form action="<?php echo e($url->make("auth.admin.charters.default")); ?>" method="post">
                <?php $__currentLoopData = $charters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row my-1 box text-center py-2">
                        <div class="col-sm-12 col-md-6">
                            <?php echo e($charter->title); ?>

                        </div>
                        <div class="col-sm-12 col-lg-3"><a href="<?php echo e($url->make("auth.admin.charters.edit",["id"=>base64_encode($charter->id)])); ?>">Edit Charter</a></div>
                        <div class="col-sm-12 col-lg-3"><a href="<?php echo e($url->make("auth.admin.charters.delete",["id"=>base64_encode($charter->id)])); ?>">Delete Article</a></div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </form>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Charters/index.blade.php ENDPATH**/ ?>