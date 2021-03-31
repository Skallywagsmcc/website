
<?php $__env->startSection("title"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <a href="<?php echo e($url->make("admin.category.create")); ?>">New Category</a>
    <div class="row text-center">
        <div class="col-md-3">Category title</div>
        <div class="col-md-3">Category SLug</div>
        <div class="col-md-6">Category Options</div>
    </div>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-md-6"><?php echo e($category->title); ?></div>
            <div class="col-md-3"><a href="<?php echo e($url->make("pages.home",["category"=>$category->slug])); ?>"><?php echo e($category->slug); ?></a></div>
            <div class="col-md-3"><a href="<?php echo e($url->make("admin.category.delete",["id"=>base64_encode($category->id)])); ?>">Delete</a></div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Categories/index.blade.php ENDPATH**/ ?>