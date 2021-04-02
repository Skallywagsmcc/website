


<?php $__env->startSection("content"); ?>
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            <?php echo $__env->make("Includes.AccountNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Your Profile
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($error)): ?>
                        <div class="alert-dark text-center"><?php echo e($error); ?></div>
                    <?php endif; ?>
                    <?php if(isset($values)): ?>

                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul>
                                <li>
                                    <?php echo e($data); ?>

                                </li>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <form action="<?php echo e($url->make("account.basic.store")); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label for="first_name">Your username : </label>
                            <input type="text" class="form-control-plaintext text-white" readonly name="username"
                                   value="<?php echo e($user->username); ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control" name="first_name"
                                       value="<?php echo e($user->Profile->first_name); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control" name="last_name"
                                       value="<?php echo e($user->Profile->last_name); ?>">
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="dob">Date of birth </label>
                            <input type="date" class="form-control" name="dob" value="<?php echo e($user->profile->dob); ?>">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="password">Enter Your Password (this is required) </label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group col-sm-12 text-right">
                            <button class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/basic.blade.php ENDPATH**/ ?>