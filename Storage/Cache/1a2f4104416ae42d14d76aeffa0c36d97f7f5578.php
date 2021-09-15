

<?php $__env->startSection("title"); ?>
    Events viewer <?php echo e($event->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <div class="container my-2">
        <div class="row mx-1">
            <div class="col-sm-12 head">Our Events </div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-xs-12 px-0" id="cover_image">
                    <img src="/img/uploads/<?php echo e($event->CoverImage->name); ?>" alt=" <?php echo e($user->username); ?> Profile Image">
                </div>


                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/<?php echo e($event->image->name); ?>" class="profile_pic justify-content-center"
                                                                height="150" width="150" alt=" <?php echo e($event->image->title); ?>"></div>
            </div>

            <div class="col-sm-12" id="profile_name"><?php echo e($event->title); ?> </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1">
            <div class="col-sm-12 head">About The event</div>
            <div class="col-sm-12 lb2 py-2 my-1 text-center"><?php echo nl2br($event->content); ?></div>
        </div>
    </div>




    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="head">Event Details</div>
                <div class="lb2 my-md-1 py-2 text-center">Event Start : <?php echo e(date("H:i",strtotime($event->start_at))); ?> on <?php echo e(date("d/m/Y",strtotime($event->start_at))); ?></div>
                <div class="lb2 my-md-1 py-2 text-center">Event End : <?php echo e(date("h:iA",strtotime($event->start_at))); ?> <?php echo e(date("d/m/Y",strtotime($event->start_at))); ?></div>

                <div class="row mx-0 my-2">
                    <div class="col-sm-12 lb2  col-lg-4 py-2 text-md-right d-flex justify-content-center"><img src="/img/uploads/<?php echo e($event->user->Profile->Image->name); ?>" alt="" class="profile_pic  my-2" height="50" width="50"></div>
                    <div class="col-sm-12 lb2 col-lg-8 py-2 text-center  d-block">
                        <div class="text-center lb2">Event Created by</div>
                        <div>
                            <a class="py-2 py-md-0 lb2 text-center" href="<?php echo e($url->make("profile.view",["username"=>$event->user->username])); ?>"><?php echo e($event->user->username); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $startlocation = explode(",",$event->esl);
                $endlocation = explode(",",$event->eel);
            ?>
            <div class="col-sm-12 col-lg-8">
                <div class="head">Journey Overview</div>
                <div class=" my-md-1 py-2">
                    <div class="row mx-0 text-center">
                        <div class="col-sm-12 col-lg-5 lb2 my-2 text-center">
                             From : <?php echo e($startlocation[0]); ?>,<br>
                            <?php echo e($startlocation[4]); ?> </div>
                        <div class="col-sm-12 col-lg-2 lb2 d-none d-md-block my-2 py-3"> -> </div>
                        <div class="col-sm-12 col-lg-5 lb2  my-2 text-center">
                            To : <?php echo e($endlocation[0]); ?>,<br>
                            <?php echo e($endlocation[4]); ?></div>
                    </div>
                    <div class="lb2 .col-sm-12 my-md-1 text-center py-2">
                        <?php if(empty($event->map_url)): ?>
                            No Map Address is linked to this event
                        <?php else: ?>
                        <a href="<?php echo e($event->map_url); ?>">View Map</a>
                            <?php endif; ?>
                    </div>

                </div>

                <div class="head mt-2">Meet up Location </div>
                <div class="lb2 my-md-1 py-2 text-center text-md-left pl-md-3">
                    House or buildiing Name / number : <?php echo e($startlocation[0]); ?>,<br>
                    Street : <?php echo e($startlocation[1]); ?>,<br>
                    City : <?php echo e($startlocation[2]); ?>,<br>
                    County : {$startlocation[3]}},<br>
                    Post Code : <?php echo e($startlocation[4]); ?>

                </div>

                <div class="head mt-2">Event Destination </div>
                <div class="lb2 my-md-1 py-2 text-center text-md-left  pl-md-3">
                    House or buildiing Name / number : <?php echo e($endlocation[0]); ?>,<br>
                    Street : <?php echo e($endlocation[1]); ?>,<br>
                    City : <?php echo e($endlocation[2]); ?>,<br>
                    County : <?php echo e($endlocation[3]); ?>,<br>
                    Post Code : <?php echo e($endlocation[4]); ?>

                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Events/View.blade.php ENDPATH**/ ?>