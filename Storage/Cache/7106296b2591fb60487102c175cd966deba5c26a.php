

<?php $__env->startSection("title"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

    <?php if(isset($request)): ?>


        <?php if($status == true): ?>
            Registration is Open to the public
        <?php else: ?>

            <?php if(isset($request->error)): ?>
                <div class="container-fluid my-2">
                    <div class="row box">
                        <div class="col-sm-12 head">An Error Occurred</div>
                        <div class="col-sm-12 py-2 text-center">
                            <?php echo e($request->error); ?>

                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <div class="container-fluid my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2">Private Registration : User Creation</div>
                </div>
            </div>
            <div class="container-fluid my-2">
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
                                       value="<?php if(isset($post)): ?><?php echo e($post->email); ?><?php endif; ?>"/>
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

                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       <?php endif; ?>
    <?php endif; ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Users/new.blade.php ENDPATH**/ ?>