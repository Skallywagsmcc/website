


<?php $__env->startSection("title"); ?>
    Admin panel Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <?php if(isset($error)): ?>
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 head">An Error Occurred</div>
                <?php echo e($error); ?>

                <?php if(isset($rmf)): ?>
                    <?php $__currentLoopData = $rmf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($required); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-lg-right pr-lg-2 py-2"><a class="d-block" href="<?php echo e($url->make("auth.admin.home")); ?>">Back
                    to Admin Home</a></div>
        </div>
    </div>
    
    <div class="container my-2">
        <form action="<?php echo e($url->make("auth.admin.settings.store")); ?>" method="post">

            <?php echo e(csrf()); ?>

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Email Address:</div>
                <div class="col-sm-12">
                    <input type="text" class="form-control my-2" name="email" value="<?php echo e($settings->contact_email); ?>">
                </div>
            </div>

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Telephone Number</div>
                <div class="col-sm-12">
                    <input type="text" class="form-control my-2" name="telephone"
                           value="<?php echo e($settings->contact_telephone); ?>">
                </div>
            </div>

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Address</div>
            </div>
            <?php if($addresses->count() == 0): ?>
                <div class="row box">
                    <div class="col-sm-12 text-center py-2">
                        No Addresses Have Been created yet <a href="<?php echo e($url->make("auth.admin.addresses.new")); ?>">Add new Address</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row box">
                    <div class="col-sm-12 text-center py-2 text-center text-lg-right pr-lg-2">
                        <a href="<?php echo e($url->make("auth.admin.addresses.new")); ?>">Add new Address</a>
                    </div>
                </div>
                <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row box my-2">
                    <div class="col-sm-12 col-lg-8 py-2 text"><?php echo e($address->title); ?></div>
                    <div class="col-sm-12 col-lg-4 py-2 text-center"><a class="d-block" href="<?php echo e($url->make("auth.admin.addresses.view",["id"=>base64_encode($address->id)])); ?>">View Address</a></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <div class="row box m-2">
            </div>
            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : maintainence Status</div>
                <div class="col-sm-12">
                    <select name="maintainence_status" class="form-control py-2 bg-dark text-white my-2" id="">
                        <?php if($settings->maintainence_status == 1): ?>
                            <option class="py-2" value="1"> Current Selection : Maintainence Mode off</option>
                        <?php else: ?>
                            <option class="py-2" value="0"> Current Selection : Maintainence Mode on</option>
                        <?php endif; ?>
                        <option class="py-2" value="0">Turn on Maintainence Mode</option>
                        <option class="py-2" value="1">Turn off Maintainence Mode</option>
                    </select>
                </div>
            </div>

            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : Login Control</div>
                <div class="col-sm-12">
                    <select name="open_login" class="form-control py-2 bg-dark text-white my-2" id="">
                        <?php if($settings->open_login == 1): ?>
                            <option class="py-2" value="1"> Current Selection : public Login</option>
                        <?php else: ?>
                            <option class="py-2" value="0"> Current Selection : Admin only login</option>
                        <?php endif; ?>
                        <option class="py-2" value="0">Set to Admin Only Login</option>
                        <option class="py-2" value="1">Set to public Login</option>
                    </select>
                </div>
            </div>
            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : Registration Control</div>
                <div class="col-sm-12">
                    <select name="open_registration" class="form-control py-2 bg-dark text-white my-2" id="">
                        <?php if($settings->open_registration == 1): ?>
                            <option class="py-2" value="1"> Current Selection : public Registration</option>
                        <?php else: ?>
                            <option class="py-2" value="0"> Current Selection : Invite Only registration</option>
                        <?php endif; ?>
                        <option class="py-2" value="0">Set to Invite only registration</option>
                        <option class="py-2" value="1">Set to public Registration</option>
                    </select>
                </div>
            </div>


























            <div class="row my-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark py-2 my-2">Update Settings</button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/settings.blade.php ENDPATH**/ ?>