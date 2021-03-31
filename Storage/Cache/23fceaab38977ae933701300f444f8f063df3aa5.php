

<?php $__env->startSection("title"); ?>
    <?php echo e($_SERVER['APP_NAME']); ?> Search Results
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <?php if($count == 1): ?>
        <?php echo e(redirect($url->make("pages.view",["category"=>$category->slug,"slug"=>$page->first()->slug]))); ?>

    <?php elseif($count > 1): ?>
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-12 head">
                    <?php echo e($page->title); ?>

                </div>
                <div class="col-md-12">
                    <?php echo nl2br($page->content); ?>

                    <hr>
                </div>
                <div class="col-md-6">Date created <?php echo e($page->created_at); ?></div>
                <div class="col-md-6 text-right"><a href="<?php echo e($url->make("pages.view",["category"=>$page->category->slug,"slug"=>$page->slug])); ?>">View Article</a></div>
            </div>
            <?php echo $links; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        No articles found;
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Search/view.blade.php ENDPATH**/ ?>