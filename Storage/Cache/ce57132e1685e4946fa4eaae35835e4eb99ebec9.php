
<?php $__env->startSection("title"); ?>
    (Home)
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>


    <div class="container">
        <div class="row info my-2 text-center py-2">
            <?php if($events->count() == 0): ?>
                <div class="col-sm-12">No Upcoming events</div>
                <?php else: ?>
            <div class="col-sm-12 col-md-3">Next Upcoming Event</div>
            <div class="col-sm-12 col-md-9">This is coming soon</div>
                <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head pl-3 mb-1">Welcome to Skallywags</div>
            <div class="col-sm-12">
                <iframe class="p-0 text-right" width="100%" height="315"
                        src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head">Featured Images</div>
            <?php if($featured->count() >= 1): ?>
                <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-md-4 my-2">
                    <div class="col-sm-12">
                        <img class="border border-primary" src="/img/uploads/<?php echo e($image->Image->image_name); ?>" width="250"
                             height="250" alt=""/>
                    </div>
                    <div class="col-sm-12 text-sm-center text-right">
                        <a href="<?php echo e($url->make("gallery.home",["username"=>$image->Image->user->username])); ?>"><?php echo e($image->Image->user->username); ?></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-sm-12">No Featured images added</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 head">Latest Articles</div>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12">
                        <a href="<?php echo e($url->make("articles.view",["slug"=>$page->slug])); ?>"><?php echo e($page->title); ?></a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 head">Newest Club Member</div>
                <img src="/img/uploads/<?php echo e($member->first()->User->Profile->image->image_name); ?>"  height="200px" width="100%" alt="<?php echo e($member->first()->User->username); ?> Profile Image">
                <div class="col-sm-12 text-right"><a href="<?php echo e($url->make("members.home")); ?>">All members</a></div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Homepage/index.blade.php ENDPATH**/ ?>