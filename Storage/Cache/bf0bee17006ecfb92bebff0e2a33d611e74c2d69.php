

<?php $__env->startSection("title"); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <h6>List of Roles in this site</h6> <a href="/admin/roles/new">Create a new role</a>
    <?php if($count == 0): ?>
        No Roles found on the database
    <?php else: ?>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Roles list is : <?php echo e($role->title); ?>  | <a href="/admin/roles/edit/<?php echo e($role->id); ?>">Edit</a> | <a href="/admin/roles/delete/<?php echo e($role->id); ?>">Delete</a><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Roles/index.blade.php ENDPATH**/ ?>