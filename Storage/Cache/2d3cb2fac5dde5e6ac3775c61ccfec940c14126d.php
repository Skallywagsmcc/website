

<?php $__env->startSection("title"); ?>
    Admin Panel New Article
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        
        <?php if(isset($error)): ?>
            <div class="row box">
                <div class="col-sm-12 head py-2">An Errorm Occurred</div>
                <div class="col-sm-12"><?php echo e($error); ?></div>

            </div>
            <?php if(isset($rmf)): ?>
                <?php $__currentLoopData = $rmf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 py-2"><?php echo e($required); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center">Create a new Article</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 box py-2">
                <form action="<?php echo e($url->make("auth.admin.articles.store")); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf()); ?>

                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="text" class="form-control tld-input" name="title" value="<?php if(isset($post)): ?><?php echo e($post->title); ?><?php endif; ?>">
                    </div>
                    <div class="form-group">
            <textarea name="content" rows="10" class="form-control tld-input"><?php if(isset($post)): ?><?php echo e($post->content); ?><?php endif; ?></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">Create Page</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Articles/new.blade.php ENDPATH**/ ?>