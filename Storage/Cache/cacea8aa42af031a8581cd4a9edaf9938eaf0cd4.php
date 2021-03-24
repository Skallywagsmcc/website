


<?php $__env->startSection("content"); ?>
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            <?php echo $__env->make("Includes.AccountNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">

                <div class="col head">
                    About you.
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <h3 class="alert-dark text-center">
                        <?php if(isset($error)): ?>
                            <?php echo e($error); ?>

                        <?php endif; ?>
                    </h3>

                    <form action="/account/edit/about" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label for="about">About yourself : </label>
                            <textarea name="about"  rows="10" class="form-control"><?php echo e($user->Profile->about); ?></textarea>
                        </div>
                        <input type="file" name="upload">
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

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/About.blade.php ENDPATH**/ ?>