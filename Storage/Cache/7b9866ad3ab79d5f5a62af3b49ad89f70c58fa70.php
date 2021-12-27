
<?php $__env->startSection("title"); ?>
    Manage Featuured Images
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>

    <?php if(isset($error)): ?>
        <div class="container my-2">
            <div class="row box mx-1 mx-lg-0 mx-lg-0 text-center">
                <div class="col-sm-12 head">An Error Occurred</div>
                <div class="col-sm-12 py-2"><?php echo e($error); ?></div>
                <ol class="col-sm-12 text-center text-lg-left">
                    <?php if(isset($rmf)): ?>
                        <?php $__currentLoopData = $rmf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($required); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ol>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?php echo e($url->make("installer.profile.store")); ?>" method="post">

        <div class="container">
            <div class="row box mx-1 mx-lg-0 mx-lg-0 my-2">
                <div class="col-sm-12 head py-2">User Account details</div>
            </div>
            <div class="form-row mx-1 mx-lg-0 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Username</Label></div>


                    <div class="col-sm-12"><input type="text" class="form-control" name="username" value="<?php if(isset($post)): ?><?php echo e($post->username); ?><?php endif; ?>"></div>
                </div>

                

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Email Address</Label></div>
                    <div class="col-sm-12 "><input type="text" class="form-control" name="email" value="<?php if(isset($post)): ?><?php echo e($post->email); ?><?php endif; ?>"></div>
                </div>
            </div>

            <div class="row box my-2 mx-1 mx-lg-0">
                <div class="col-sm-12 head py-2">Create your Password</div>
            </div>


            <div class="form-row mx-1 mx-lg-0">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label for="password">Password</Label></div>
                    <div class="col-sm-12"><input type="password" class="form-control" name="password"></div>
                </div>

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label for="confirm">Confirm password</Label></div>
                    <div class="col-sm-12"><input type="password" class="form-control" name="confirm"></div>
                </div>
            </div>




            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2">Profile Information</div>
                </div>
            </div>

            <div class="form-row mx-1 mx-lg-0 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>first Name</Label></div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="first_name" value="<?php if(isset($post)): ?><?php echo e($post->first_name); ?><?php endif; ?>"></div>
                </div>

                

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Last Name</Label></div>
                    <div class="col-sm-12 "><input type="text" class="form-control" name="last_name" value="<?php if(isset($post)): ?><?php echo e($post->last_name); ?><?php endif; ?>"/></div>
                </div>
            </div>

            <div class="row box mx-1 mx-lg-0">
                <div class="col-sm-12 head py-2">Optional Settings</div>
            </div>

            <div class="form-row my-2 mx-1 mx-lg-0 mx-lg-0 box py-2">
                <div class="col-sm-12 col-lg-6"><label for="open_reg">Allow Public Registration</label></div>
                <div class="col-sm-12 col-lg-6 text-lg-left pl-lg-2"><input type="checkbox" value="1" name="open_reg"></div>
            </div>

            <div class="form-row my-2 mx-1 mx-lg-0 mx-lg-0 box py-2">
                <div class="col-sm-12 col-lg-6"><label for="open_reg">Allow Publc login</label></div>
                <div class="col-sm-12 col-lg-6 text-center text-lg-left pl-lg-2"><input type="checkbox" value="1" name="open_login"></div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark">Save and continue</button>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.installer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Installer/index.blade.php ENDPATH**/ ?>