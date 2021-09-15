

<?php $__env->startSection("title"); ?>
    Charters
<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row head">List a new Charter</div>
        <form action="<?php echo e($url->make("auth.admin.charters.update")); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf()); ?>

            <input type="text" name='id' value="<?php echo e($charter->id); ?>">
            <div class="form-group">
                <label for="title">Charter Name</label>
                <input type="text" name="title" class="form-control" value="<?php echo e($charter->title); ?>">
            </div>
            <div class="form-group">
                <label for="content">Information about the charter</label>
                <textarea name="content" id="" cols="30" rows="10" class="form-control"><?php echo e($charter->content); ?></textarea>
            </div>

            <div class="form-group">
                <label for="url">Charter Url</label>
                <input type="url" name="url" value="<?php echo e($charter->url); ?>" placeholder="url to charter group">
            </div>

            Thumbnail Image :  <input type="file" name="thumb">
            Cover Image : <input type="file" name="cover">


            <div class="form-group">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Charters/edit.blade.php ENDPATH**/ ?>