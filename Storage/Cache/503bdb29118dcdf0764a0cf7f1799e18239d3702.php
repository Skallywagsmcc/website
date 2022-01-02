


<?php $__env->startSection("title"); ?>
    Admin panel : New Event
<?php $__env->stopSection(); ?>



<?php $__env->startSection("content"); ?>

    <?php if(isset($error)): ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-left pl-2">An error occurred</div>
                <?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12"><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if($addresses->count() >= 2): ?>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="<?php echo e($url->make("auth.admin.events.home")); ?>">Back
                    to Events Home</a></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1"> Basic Event Details</div>
        </div>
    </div>

    <?php if(isset($values)): ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col sm-12 p-2 text-center">
                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        Missing value : <?php echo e($value); ?> <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <form action="<?php echo e($url->make("auth.admin.events.store")); ?>" method="post" class="tld-form"
          enctype="multipart/form-data">

        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12 px-2 py-2 px-2">
                    <?php echo e(csrf()); ?>

                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" class="form-control tld-input" name="title"
                               value="<?php if(isset($validate)): ?><?php echo e($validate->Post("title")); ?> <?php endif; ?>"
                               placeholder="Event Title">
                    </div>

                    <div class="form-group">
                        <label for="content">About the event</label>
                        <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                  name="content"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start">Event Start time</label>
                        <input type="datetime-local" class="form-control tld-input" name="start">
                    </div>


                    <div class="form-group">
                        <label for="end">Event end time</label>
                        <input type="datetime-local" class="form-control tld-input" name="end">
                    </div>

                </div>
            </div>
        </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-6 pr-lg-2 px-0 box my-2">
                        <div class="col-sm-12"><label for="meet_id">Event Meet up</label></div>
                        <div class="col-sm-12 p-2 ">
                            <select name="meet_id" id="" class="form-control my-1">
                                <option value="0">Make a Selection</option>
                                <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($address->id); ?>"><?php echo e($address->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 px-0 pl-lg-2 box my-2">
                        <div class="col-sm-12"><label for="dest_id">Event Destination</label></div>
                        <div class="col-sm-12 p-2">

                            <select name="dest_id" id="" class="form-control my-1">
                                <option value="0">Make a Selection</option>
                                <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($address->id); ?>"><?php echo e($address->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
        </div>


        <div class="container">
            <div class="row px-0">
                <div class="col-sm-12 col-lg-6 box my-2 px-0">
                    <div class="col-sm-12"><label for="thumb">Add event thumbnail (required)</label></div>
                    <div class="col-sm-12 py-2">
                        <input type="file" class="form-control" name="thumb">
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 box my-2 px-0">
                    <div class="col-sm-12"><label for="thumb">Add event Cover image</label></div>
                    <div class="col-sm-12 py-2">
                        <input type="file" class="form-control" name="cover">
                    </div>
                </div>
            </div>
        </div>



        <div class="container my-2">
            <div class="row box py-2">
                <div class="col-sm-12"><label for="map_url">Add a map link to your event</label></div>
                <div class="col-sm-12">
                    <input type="url" name="map_url" class="form-control tld-input" value=""
                           placeholder="Url to Map">
                </div>
            </div>
            <div class="container my-2">
                <div class="row box p ">
                    <div class="col-sm-12 py-2 px-2">
                        <button class="btn tld-button btn-block">Create Event</button>
                    </div>
                </div>
            </div>
    <?php else: ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">Not Enough Addresses</div>
                <div class="col-sm-12 text-center py-2">Sorry in order to add a new Event a Minimum of 2 addresses must be added  Before you can create a new event <a href="<?php echo e($url->make("auth.admin.addresses.home")); ?>">Add a new
                        Address</a></div>
            </div>
        </div>
    <?php endif; ?>





<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Events/new.blade.php ENDPATH**/ ?>