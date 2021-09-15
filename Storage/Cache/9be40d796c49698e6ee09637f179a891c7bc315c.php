
<?php $__env->startSection("title"); ?>
    Security : Change Email
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="<?php echo e($url->make("security.home")); ?>">Back to Security Home</a></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2 head">Update Email Address</div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="<?php echo e($url->make("security.email.store")); ?>" method="post">
                    <?php echo e(csrf()); ?>

                    <div class="form-row my-2">
                        <div class="col-sm-12 col-md-3 py-1 pr-md-2 text-center text-md-right ">
                            <label for="email">Your Email Address</label>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <input type="email" name="email" class="form-control"
                                   value="<?php if(isset($user)): ?><?php echo e($user->email); ?><?php endif; ?>">
                        </div>

                    </div>
                    <div class="form-row my-2">
                        <div class="col-sm-12 col-md-3 text-center text-md-right pr-md-2 py-1 ">Your Password</div>
                        <div class="col-sm-12 col-md-9 px-2"><input type="password" name="password"
                                                                    class="form-control"/></div>
                    </div>
                    <button class="btn btn-block btn-dark">update Password</button>
                </form>
            </div>

        </div>
    </div>


    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/UserCp/Account/Security/EmailChange.blade.php ENDPATH**/ ?>