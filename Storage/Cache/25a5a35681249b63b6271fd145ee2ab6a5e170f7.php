
<?php $__env->startSection("title"); ?>
    Skallywagsmcc Articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
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
            <div class="col-md-6 text-right"><a href="/articles/view/<?php echo e($article->slug); ?>">View Article</a></div>
        </div>
        <?php echo e($article->id); ?> The title of this site is <u><?php echo e($article->title); ?></u> by user <?php echo e($article->user->username); ?> <a
        <hr>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Articles/index.blade.php ENDPATH**/ ?>