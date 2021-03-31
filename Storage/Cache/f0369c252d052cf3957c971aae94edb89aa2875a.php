

<?php $__env->startSection("title"); ?>
    Admin Panel New Article
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Includes.AdminNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo e($message); ?>

<?php if(isset($values)): ?>
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    Missing <?php echo e($value); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<div class="head">Create a new Article</div>
    <form action="<?php echo e($url->make("admin.pages.store")); ?>" method="post">
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo e($article->title); ?>">
        </div>
        <div class="form-group">
            <select name="category" id="">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <textarea name="content" id="editor" cols="30" rows="10" class="form-control"><?php echo e($article->content); ?></textarea>
        </div>
        <div class="form-group text-right">
            <button class="btn btn-primary">Create Article</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Blogs/NewBlog.blade.php ENDPATH**/ ?>