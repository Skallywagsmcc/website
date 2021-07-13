
<?php $__env->startSection("title"); ?>
    (Home)
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>


































    <div class="container">
        <div class="row my-3">
            <div class="col-sm-12 head">Updates</div>
            <div class="col-sm-12">18/06/2021 : We are currently working on the layout and other small improvements to
                the frontend of the site
            </div>
            <div class="col-sm-12">19/06/2021 : Fixed Login Box Remember Me Session, Added Events Lisiting to the homepage
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-12 head">Beta Notice</div>
            <div class="col-sm-12">
                Welcome: although this site is operational, the site is in Beta which means some things may break and
                some things may change all change and code can be found <a
                        href="http://github.com/skallywagsmcc">Here</a>
                <hr>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row event my-2 text-center py-2 px-0">
            <?php if($events->count() == 0): ?>
                <div class="col-sm-12">No Upcoming events</div>
            <?php else: ?>
                <div class="col-sm-12 col-md-2">Next Event : </div>
                <div class="col-sm-12 col-md-6">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($url->make("events.view",['slug'=>$event->slug])); ?>"><?php echo e($event->title); ?></a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-sm-12 col-md-3">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(date("d/m/Y",strtotime($event->start)) == date("d/m/Y")): ?>
                            
                            <?php if(date("H:i:s",strtotime("+1 Hour")) < date("H:i:s",strtotime($event->start))): ?>
                                Event today at <?php echo e(date("H:i:s",strtotime($event->start))); ?>

                                
                                Event start at : <?php echo e(date("H:i:s",strtotime($event->start))); ?>

                                <?php elseif(date("H:i:s",strtotime("+1 Hour")) > date("H:i:s",strtotime($event->end))): ?>
                                Event Ended
                            <?php else: ?>
                               Event starts on <?php echo e(date("d/m/Y",strtotime($event->start))); ?>

                                <?php endif; ?>
                        <?php else: ?>
                            Event starts on <?php echo e(date("d/m/Y",strtotime($event->start))); ?>

                            <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
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
        <div class="row my-3 ">
            <div class="col-sm-12 head">Featured Images</div>
            <?php if($featured->count() >= 1): ?>
                <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-4 my-2">
                        <div class="col-sm-12">
                            <img class="border border-primary" src="/img/uploads/<?php echo e($image->Image->image_name); ?>"
                                 width="250"
                                 height="250" alt=""/>
                        </div>
                        <div class="col-sm-12 text-sm-center text-right">
                            <a href="<?php echo e($url->make("profile.gallery.home",["username"=>$image->Image->user->username])); ?>"><?php echo e($image->Image->user->username); ?></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-sm-12">No Featured images added</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="container my-3">
        <div class="row my-sm-2">
            <div class="col-sm-12 col-md-8 px-0 pr-md-2">
                <div class="info">
                    <div class="col-sm-12 head">Latest Articles</div>
                    <?php if($pages->count() >= 1): ?>
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-12 ">
                                <a href="<?php echo e($url->make("articles.view",["slug"=>$page->slug])); ?>"><?php echo e($page->title); ?></a>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 px-0 text-center text-md-right"><a href="<?php echo e($url->make("articles.home")); ?>">View More articles</a></div>
                    <?php else: ?>
                        <div class="col-sm-12 text-center px-0">No Articles Found</div>
                    <?php endif; ?>

                </div>

            </div>
            <div class="col-sm-12 col-md-4  px-0 pl-md-2 ">
                <div class="info">
                    <div class="col-sm-12 head">Newest Club Member</div>
                    <?php if($member->count() >= 1): ?>
                        <img src="/img/uploads/<?php echo e($member->first()->User->Profile->image->image_name); ?>" height="200px"
                             width="100%" alt="<?php echo e($member->first()->User->username); ?> Profile Image" class="my-1">
                        <div class="col-sm-12 text-right"><a href="<?php echo e($url->make("members.home")); ?>">All members</a></div>
                    <?php else: ?>
                        <div class="col-sm-12 text-center pr-md-0 px-0">No Members found</div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Homepage/index.blade.php ENDPATH**/ ?>