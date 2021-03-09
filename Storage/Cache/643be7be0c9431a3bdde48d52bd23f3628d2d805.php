


<?php $__env->startSection("content"); ?>

    <?php if($user->profile_count == 1): ?>
        we found your profile <a href="/profile/editor/manage">Edit your profile</a>
    <?php else: ?>
        <form action="/profile/editor/create" method="post">
            <button>Create your profile</button>
        </form>
    <?php endif; ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Profile/index.blade.php ENDPATH**/ ?>