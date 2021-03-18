

<?php $__env->startSection("title"); ?>
    Image found
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>


    <?php if($count == 0): ?>
        no page found Click this link here
    <?php else: ?>
    <div class="text-center">
        <img src="/img/uploads/<?php echo e($image->image_name); ?>" height="400" width="400"
             alt="<?php echo e($image->image_name); ?>">
        <?php if($image->user->id == \App\Http\Libraries\Authentication\Auth::id()): ?>
            <a href="/profile/<?php echo e($image->user->username); ?>/gallery/image/delete/<?php echo e(base64_encode($image->id)); ?>">Delete image</a>
        <?php endif; ?>
    </div>


        <?php $__currentLoopData = $image->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($comment->user->username); ?> Says :    <?php echo e($comment->comment); ?> <?php if($comment->user->id == \App\Http\Libraries\Authentication\Auth::id()): ?>
                | <a href="/profile/<?php echo e($comment->user->username); ?>/gallery/comment/delete/<?php echo e(base64_encode($comment->id)); ?>">Delete comment</a>
            <?php endif; ?><br>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <form action="/profile/<?php echo e($user->username); ?>/gallery/comments/add" method="post">
            <?php echo e(csrf()); ?>

            <input type="hidden" name="id" value="<?php echo e($image->id); ?>">
            <textarea name="comment"></textarea>
            <button>Save</button>
        </form>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Profile/Gallery/view.blade.php ENDPATH**/ ?>