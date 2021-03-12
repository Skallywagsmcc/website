

<?php $__env->startSection("title"); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <form action="/admin/users/search" method="post">
        <input type="text" name="keyword" placeholder="enter keyword">
        <button name="save">Search</button>
    </form>
    <a href="/admin/users/new">Create new User</a><hr>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(empty($user->username)): ?>
            username : <?php echo e($user->email); ?> |
        <?php else: ?>
      email : <?php echo e($user->email); ?> | username : <?php echo e($user->username); ?> |
        <?php endif; ?>
        <a href="/admin/users/roles/<?php echo e($user->id); ?>">List of roles</a>  | <a href="/admin/users/delete/<?php echo e($user->id); ?>">Delete user </a>
        <br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Users/index.blade.php ENDPATH**/ ?>