

<?php $__env->startSection("title"); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>


    <div class="row text-center head">
        <div class="col-md-2">Username</div>
        <div class="col-md-2">Email Address</div>
        <div class="col-md-2">Full Name</div>
        <div class="col-md-4">Account Options</div>
        <div class="col-md-2 btn-primary"><a href="/admin/users/new">New user</a></div>
    </div>

    <div class="row text-center mb-3">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-2 col-xs-12"><?php echo e($user->username); ?></div>
            <div class="col-md-2 col-xs-12"><?php echo e($user->email); ?></div>
            <div class="col-md-2 col-xs-12"><?php echo e($user->Profile->first_name); ?> <?php echo e($user->Profile->last_name); ?></div>
            <div class="col-md-2 col-xs-12 "><a href="">Roles</a></div>
            <div class="col-md-2 col-xs-12 "><a href="/admin/users/edit/<?php echo e(base64_encode($user->id)); ?>/<?php echo e(base64_encode($user->username)); ?>">Edit Account</a></div>
        <?php if($user->id  == \App\Http\Libraries\Authentication\Auth::id()): ?>
            <div class="col-md-2 col-xs-12">Unavailable</div>
            <?php else: ?>
            <div class="col-md-2 col-xs-12"><a href="<?php echo e($url->make("admin.users.delete",["id"=>$user->id])); ?>">Delete Account</a></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/Users/index.blade.php ENDPATH**/ ?>