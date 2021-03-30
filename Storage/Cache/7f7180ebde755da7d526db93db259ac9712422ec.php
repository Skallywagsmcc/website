
<?php $__env->startSection("title"); ?>
    Skallywagsmcc Article <?php echo e($article->slug); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="row my-2">
        <div class="col-sm-12 head">
            <?php echo e($article->title); ?>

        </div>
        <div class="col-sm-12">
            <?php echo e($article->content); ?>

        </div>
        <div class="border border-light col-sm-12"></div>
<div class="col-sm-12 col-md-6">Posted By : <?php echo e($article->user->username); ?></div>
<div class="col-sm-12 col-md-6">Posted on : <?php echo e($article->created_at); ?></div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Articles/view.blade.php ENDPATH**/ ?>