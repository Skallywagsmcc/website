
<?php $__env->startSection("title"); ?>
    Skallywagsmcc Articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center my-2">
                <?php echo $links; ?>

            </div>
            <div class="col-sm-12 col-md-2 text-center my-1">
                <div class="col-sm-12 head">By Year</div>
            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($url->make("articles.year",["year"=>$year->year])); ?>">  <?php echo e($year->year); ?></a>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-sm-12 col-md-10">
                <?php if($count >= 1): ?>


                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row my-1">
                            <div class="col-md-12 head">
                                <?php echo e($article->title); ?>

                            </div>
                            <div class="col-md-12">
                                <?php echo nl2br($article->content); ?>

                                <hr>
                            </div>
                            <div class="col-md-6">Article created <?php echo e(date("d/m/Y H:i:s",strtotime($article->created_at))); ?></div>
                            <div class="col-md-6 text-right"><a href="<?php echo e($url->make("articles.view",["slug"=>$article->slug])); ?>">View Article</a></div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    No articles found;
                <?php endif; ?>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Articles/index.blade.php ENDPATH**/ ?>