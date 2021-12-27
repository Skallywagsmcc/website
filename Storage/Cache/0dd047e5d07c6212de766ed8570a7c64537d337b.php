
<?php $__env->startSection("title"); ?>
    (Home)
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="row my-2 text-center py-2 px-0 lb2 mx-2 mx-md-0">
            <?php if($events->count() == 0): ?>
                <div class="col-sm-12">No Upcoming events</div>
            <?php else: ?>
                <div class="col-sm-12 col-md-2">Next Event :</div>
                <div class="col-sm-12 col-md-6 text-center">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($url->make("events.view",['slug'=>$event->slug])); ?>"><?php echo e($event->title); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-sm-12 col-md-3">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(date("d/m/Y",strtotime($event->start_at)) == date("d/m/Y")): ?>
                            
                            <?php if(date("H:i:s",strtotime("+1 Hour")) < date("H:i:s",strtotime($event->start_at))): ?>
                                Event today at <?php echo e(date("H:i:s",strtotime($event->start_at))); ?>

                                
                                Event start at : <?php echo e(date("H:i:s",strtotime($event->start_at))); ?>

                            <?php elseif(date("H:i:s",strtotime("+1 Hour")) > date("H:i:s",strtotime($event->end_at))): ?>
                                Event Ended
                            <?php else: ?>
                                Event starts on <?php echo e(date("d/m/Y",strtotime($event->start_at))); ?>

                            <?php endif; ?>
                        <?php else: ?>
                            Event starts on <?php echo e(date("d/m/Y",strtotime($event->start_at))); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>



    <div class="container">
        <div class="row mx-2 mx-md-0 lb2">
            <div class="col-sm-12 head pl-3 mb-1">Welcome to Skallywags</div>
            <div class="col-sm-12 p-md-0">
                <iframe class="p-0 text-right" width="100%" height="315"
                        src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container my-2">

        <form action="<?php echo e($url->make("search.view")); ?>" method="get" class="tld-form">
            <div class="row">
                <div class="col-sm-12 col-lg-9">
                    <input type="text" name="keyword" class="tld-input form-control my-2"
                           placeholder="Search for Users, Articles ,Charters or Events"></div>
                <div class="col-sm-12 col-lg-3 my-2">
                    <button class="tld-button btn-block btn">Search</button>

                </div>
            </div>
        </form>
    </div>

    <div class="container my-2">
        <div class="row mx-2 mx-md-0">
            <div class="col-sm-12 col-lg-9">
                <div class="row my-3 ">
                    <div class="col-sm-12 lb2 head">Featured Images</div>
                    <?php if($featured->count() >= 1): ?>
                        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-12 col-md-4 my-2">
                                <div class="col-sm-12 text-center">
                                    <img class="border border-primary profile_pic"
                                         src="/img/uploads/<?php echo e($image->Image->name); ?>"
                                         height="150" width="150" alt=""/>
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

                

                <div class="row my-sm-2">
                    <div class="col-sm-12  px-0 pr-md-2 mx-4 mx-md-0 lb2">

                        <div class="col-sm-12 head">Latest Articles</div>
                        <?php if($pages->count() >= 1): ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-12 ">
                                    <a href="<?php echo e($url->make("articles.view",["slug"=>$page->slug])); ?>"><?php echo e($page->title); ?></a>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-12 px-0 text-center text-md-right"><a
                                        href="<?php echo e($url->make("articles.home")); ?>">View
                                    More articles</a></div>
                        <?php else: ?>
                            <div class="col-sm-12 text-center px-0">No Articles Found</div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-lg-3">
                <div class="row mx-2 my-3">
                    <div class="col-sm-12 lb2 head">Latest Members</div>
                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 text-center mx-0">
                            <a href="<?php echo e($url->make("profile.view",["username"=>$member->user->username])); ?>"
                               class="d-block py-2 mx-0 px-0"><?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?></a>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Homepage/index.blade.php ENDPATH**/ ?>