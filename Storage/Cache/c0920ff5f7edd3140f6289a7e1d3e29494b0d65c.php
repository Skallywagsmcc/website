

<?php $__env->startSection("title"); ?>
    Admin Panel : Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($users->count()); ?> Users</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.users.home")); ?>" class="d-block text-center">Manage Users</a>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($articles->count()); ?> Articles</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.articles.home")); ?>" class="d-block text-center">Manage Articles</a>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($events->count()); ?> Events</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.events.home")); ?>" class="d-block text-center">Manage Events</a>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($charters->count()); ?> charters</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.charters.home")); ?>" class="d-block text-center">Manage Charters</a>
            </div>

            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($images->count()); ?> Image Uploads</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.images.home")); ?>" class="d-block text-center">Manage Images</a>
            </div>








            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2><?php echo e($featured->count()); ?> Featured Image Requests</h2>
                </div>
                <a href="<?php echo e($url->make("auth.admin.featured.home")); ?>" class="d-block text-center">Manage Featured Request</a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/index.blade.php ENDPATH**/ ?>