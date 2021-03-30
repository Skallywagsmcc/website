

<?php $__env->startSection("tite"); ?>
    Admin Panel : Blogs
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <div class="row">
        <div class="col-md-3">

            <a href="/admin/blog/new">New Blog</a>
        </div>
        <div class="col-md-9">
            <div class="row text-center head">
                <div class="col-md-6">Article title</div>
                <div class="col-md-6">Article Options</div>
            </div>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row text-center  m-2 mx-md-0 p-2 article-row">
                    <div class="col-md-6"><?php echo e($article->title); ?></div>
                    <div class="col-md-2"><a href="<?php echo e($url->make("pages.view",["category"=>$article->category->slug,"slug"=>$article->slug])); ?>" target="_new">View Article</a></div>
                    <div class="col-md-2"><a href="/admin/blog/edit/<?php echo e($article->slug); ?>/<?php echo e(base64_encode($article->id)); ?>">Edit Article</a></div>
                    <div class="col-md-2"><a href="/admin/blog/delete/<?php echo e($article->slug); ?>/<?php echo e(base64_encode($article->id)); ?>">Delete Article</a></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Blogs/index.blade.php ENDPATH**/ ?>