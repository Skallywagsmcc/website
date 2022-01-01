

<?php $__env->startSection("title"); ?>
    <?php echo e(APP_NAME); ?> Admin panel Addresses
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>


    <?php if(isset($error)): ?>
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center"><?php echo e($error); ?></div>
                <div class="col-sm-12.pl-lg-2 text-center text-lg-left">
                    <?php if(isset($required)): ?>
                        <?php $__currentLoopData = $required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <strong class="p-2 tu my-2"><?php echo e($required); ?></strong>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    <?php endif; ?>
    <div class="container">

        <div class="row box my-2">
            <div class="col-sm-12 text-center text-lg-left head pl-lg-2">Add new address</div>
        </div>
        <form action="<?php echo e($url->make("auth.admin.addresses.store")); ?>" method="post">
            <?php echo e(csrf()); ?>


            <div class="row box my-2 p-2">
                <div class="col-sm-12"><label for="title text-left py-2">Label For your Address</label></div>
                <div class="col-sm-12"><input type="text" class="form-control" name="title"
                                              value="<?php if(isset($post)): ?><?php echo e($post->title); ?><?php endif; ?>"
                                              placeholder="Reference of address"></div>
            </div>

            <div class="row box my-2 p-2">
                <div class="col-sm-12"><label for="title text-left py-2">Street Number or Building Name </label></div>
                <div class="col-sm-12">
                    <input type="text" name="name" class="form-control"
                           value="<?php if(isset($post)): ?><?php echo e($post->name); ?><?php endif; ?>"
                           placeholder="Building name or number">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">Street Name</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="street" class="form-control"
                                       value="<?php if(isset($post)): ?><?php echo e($post->street); ?><?php endif; ?>"
                                       placeholder="Street name">
                            </div>

                        </div>
                        <div class="col-sm-12 col-lg-6 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">Second Street name
                                    (Optional)</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="street_2" class="form-control"
                                       value="<?php if(isset($post)): ?><?php echo e($post->street_2); ?><?php endif; ?>"
                                       placeholder="Street name line 2 optional">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">City</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="city" class="form-control"
                                       value="<?php if(isset($post)): ?><?php echo e($post->city); ?><?php endif; ?>"
                                       placeholder="City">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">County</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="county" class="form-control"
                                       value="<?php if(isset($post)): ?><?php echo e($post->county); ?><?php endif; ?>"
                                       placeholder="county">
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-4 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">Postcode</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="postcode" class="form-control"
                                       value="<?php if(isset($post)): ?><?php echo e($post->postcode); ?><?php endif; ?>"
                                       placeholder="Postcode">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            

            <div class="row box my-2 p-2">
                <div class="col-sm-12 col-lg-10 text-center text-lg-right pr-lg-2"><label for="title text-left py-2">Place on contact us page</label></div>
                <div class="col-sm-12 col-lg-2 text-center">
                    <input type="checkbox" name="contactus" <?php if(isset($post)): ?> <?php if($post->contactus==1): ?> checked <?php endif; ?> <?php endif; ?> value="1">
                </div>
            </div>

            <div class="row  my-2 p-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-primary">Save Address</button>
                </div>
            </div>



        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Addresses/new.blade.php ENDPATH**/ ?>