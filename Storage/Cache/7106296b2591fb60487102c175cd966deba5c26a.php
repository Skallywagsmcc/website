

<?php $__env->startSection("title"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>




    <div class="row my-2">
        <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
            <a href="<?php echo e($url->make("auth.admin.users.home")); ?>">Back to User List</a>
        </div>
    </div>


    <div class=" my-2 box">
        
        <div class="alert-danger">Message :
            <?php if(isset($error)): ?>
                <?php echo e($error); ?>

                <?php if(isset($required)): ?>
                    <?php $__currentLoopData = $required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($required); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>


            <div class="row box text-center text-md-right pr-md-2 py-2 my-2">
                <div class="col-sm-12 ">Create a new user</div>
            </div>
        </div>
    </div>


        <div class="row">
            <div class="col-sm-12 box py-2">
                <form action="<?php echo e($url->make("auth.admin.users.store")); ?>" method="post" class="tld-form">
                    <?php echo e(csrf()); ?>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control tld-input" name="first_name"
                                       value="<?php if(isset($post)): ?><?php echo e($post->first_name); ?> <?php endif; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control tld-input" name="last_name"
                                       value="<?php if(isset($post)): ?><?php echo e($post->last_name); ?> <?php endif; ?>">
                            </div>
                        </div>
                    <div class="form-row">
                        <label for="email">Email Address : </label>
                        <input type="text" class="form-control tld-input" name="email"
                               value="<?php if(isset($post)): ?><?php echo e($post->email); ?><?php endif; ?>"
                        <?php if($status == true): ?>
                            <label for="last_name">Username : </label>
                            <input type="text" class="form-control tld-input" name="username"
                                   value="<?php if(isset($post)): ?><?php echo e($post->username); ?><?php endif; ?>"/>
                        <?php endif; ?>
                    </div>
                    <?php if($status == true): ?>
                        <div class="form-row">
                            
                            
                            
                            
                            <div class="form-group col-sm-12">
                                <label for="last_name">Create Password </label>
                                <input type="password" class="form-control tld-input" name="password">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="last_name">Confirm Password </label>
                                <input type="password" class="form-control tld-input" name="confirm" value="">
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Other Settings</h2>
                                <label for="is_admin">Set this user as Administrator</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="checkbox" name="is_admin" value="1">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Other Settings</h2>
                                <label for="is_admin">Set this user as Crew Member</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="checkbox" name="is_crew" value="1">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="admin_password">Your Admin Password</label>
                            </div>
                            <div class="col-sm-12 my-2 py-2">
                                <input type="password" class="form-control px-1" name="admin_password">
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="form-group text-right">
                        <button class="btn btn-primary btn-block">Create User</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Users/new.blade.php ENDPATH**/ ?>