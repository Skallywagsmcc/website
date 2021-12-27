



<?php $__env->startSection("title"); ?>
    Admin Panel Edit Article <?php echo e($article->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row box text-center">
            <div class="col-sm-12 py-2 head">Edit Article</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="<?php echo e($url->make("auth.admin.articles.update",["slug"=>$article->slug,"id"=>base64_encode($article->id)])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf()); ?>

                    <input type="hidden" name="id" value="<?php if(isset($article)): ?><?php echo e($article->id); ?> <?php endif; ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder tu py-2 my-1" for="title">Article Title
                            <?php if(isset($post)): ?>
                                <?php if(empty($post->title)): ?>
                                 : this field is required and cannot be empty
                                <?php endif; ?>
                            <?php endif; ?>
                        </label>
                        <input type="text" class="form-control tld-input" name="title" value="<?php if(isset($post)): ?><?php echo e($post->title); ?><?php else: ?><?php echo e($article->title); ?><?php endif; ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder tu py-2 my-1" for="title">Article Content
                            <?php if(isset($post)): ?>
                                <?php if(empty($post->content)): ?>
                                    : this field is required and cannot be empty
                                <?php endif; ?>
                            <?php endif; ?>
                        </label>
                <textarea name="content" id="" cols="30" rows="10"
                          class="form-control tld-input"><?php if(isset($post)): ?><?php echo e($post->content); ?><?php else: ?><?php echo e($article->content); ?><?php endif; ?></textarea>
                    </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block my-2">Update Page</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Articles/edit.blade.php ENDPATH**/ ?>