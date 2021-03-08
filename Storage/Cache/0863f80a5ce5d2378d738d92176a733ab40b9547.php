

<?php $__env->startSection("title"); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(empty($user->username)): ?>
            username : <?php echo e($user->email); ?> |
        <?php else: ?>
      email : <?php echo e($user->email); ?> | username : <?php echo e($user->username); ?> |
        <?php endif; ?>
        <a href="/admin/users/roles/<?php echo e($user->id); ?>">List of roles</a>  | <a href="/admin/users/delete/<?php echo e($user->id); ?>">Delete user </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Users/index.blade.php ENDPATH**/ ?>