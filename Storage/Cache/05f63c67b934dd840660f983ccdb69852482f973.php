

<?php $__env->startSection("title"); ?>
    Login to your account
<?php $__env->stopSection(); ?>
<?php $__env->startSection("head"); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row">
            <?php if($request['access'] == "restricted"): ?>
                <div class="col-sm-12 head">Access denied</div>
                <div class="col-sm-12">Access is only Accessable to Authenticated users</div>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <div class="col-sm-12 head">An error Occurred</div>
                <?php if($error == "required"): ?>
                    <h2>Please check the required fields</h2>
                    <?php $__currentLoopData = $validate::$values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($value); ?>  Missing <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php echo e($error); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>


    </div>

    <div class="container my-2">
        <div class="row mx-lg-0 mx-1">

            <div class="col-sm-12 col-lg-8 ">
                <div class="col-sm-12 head">Login To your account</div>
                <div class="col-sm-12">
                    <form action="<?php echo e($url->make("login.store")); ?><?php if(isset($request["ref"])): ?><?php echo e("?ref=".$request["ref"]); ?><?php endif; ?>"
                          method="post" class="tld-form" id="login-form">
                        <div class="form-group tld-form">
                            <label for="username">Your Username/Email Address</label>
                            <input type="text" name="username" class=" form-control tld-input"
                                   value="<?php if(isset($username)): ?><?php echo e($username); ?><?php endif; ?>"
                                   placeholder="Email Address or username">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input type="password" name="password" class="form-control tld-input"
                                   placeholder="Password">
                        </div>
                        <div class="form-row my-1">
                            <div class="col-sm-6 text-md-right text-center">
                                <label for="remember">Remember Me for 7 days</label>
                            </div>
                            <div class="col-sm-6 text-center">
                                <input type="checkbox" name="remember" value="1" class="tld-input">
                            </div>
                            <button class="g-recaptcha btn btn-block tld-button my-2"
                                    data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                    data-callback='onSubmit'
                                    data-action='login'>Login
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
            <div class="col-sm-12 head">More Options</div>
                <?php if(isset($value)): ?>
                    <?php if($value->open_registration==true): ?>
                        <div class="col-sm-12 text-center"><a href="<?php echo e($url->make("register")); ?>" class="d-block py-2">Register for an account</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="col-sm-12 text-center"><a href="<?php echo e($url->make("passwordreset.home")); ?>" class="d-block py-2">Reset Password</a></div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            <?php if(isset($value)): ?>
                <?php if($value->open_registration==true): ?>
                    <div class="col-sm-12 text-right"><a href="<?php echo e($url->make("register")); ?>">Register for an account</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Login/index.blade.php ENDPATH**/ ?>