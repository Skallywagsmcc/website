
<?php $__env->startSection("title"); ?>
    Skallywagsmcc Articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php if($count == 1): ?>
        <?php echo e(redirect($url->make("pages.view",["category"=>$category->slug,"slug"=>$articles->first()->slug]))); ?>

    <?php elseif($count > 1): ?>
    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-md-12 head">
                <?php echo e($article->title); ?>

            </div>
            <div class="col-md-12">
                <?php echo nl2br($article->content); ?>

                <hr>
            </div>
            <div class="col-md-6">Date created <?php echo e($article->created_at); ?></div>
            <div class="col-md-6 text-right"><a href="<?php echo e($url->make("pages.view",["category"=>$article->category->slug,"slug"=>$article->slug])); ?>">View Article</a></div>
        </div>
        <?php echo $links; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        No articles found;
    <?php endif; ?>

    <form action="<?php echo e($url->make("pages.search",["category"=>$article->category->slug])); ?>" method="get">
        <input type="text" name="keyword">
        <button>save</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Articles/index.blade.php ENDPATH**/ ?>