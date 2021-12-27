

<?php $__env->startSection("head"); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("register-form").submit();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>



    <?php if(isset($error)): ?>
    <div class="container my-2">
        <div class="row lb2 mx-lg-1">
            <div class="col-sm-12 lb3 text-center text-lg-left pl-lg-1 head">An Error Occurred</div>
            <div class="col-sm-12 text-center"><?php echo e($error); ?></div>
            <?php if(isset($required)): ?>
                <ol>
                    <?php $__currentLoopData = $required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-sm-12  text-center text-lg-left pl-lg-1 py-2">
                            <?php echo e($required); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>

    <?php if(($showform == true)): ?>
            <div class="container my-2">
                <div class="row my-2 lb3 mx-1">
                    <div class="col-sm-12 head text-center text-lg-left pl-lg-2">Create An Account</div>
                </div>
                <form action="<?php echo e($url->make("register.store")); ?>" method="post" class="tld-form" id="register-form">
                    <div class="form-row">
                        <div class="col-sm-12 mx-3">
                            <label for="username">Username</label>
                        </div>
                        <?php if((!is_null($request->token)) || (!is_null($post->token))): ?>
                        <div class="col-sm-12">
                            <input type="text" name="token" value="<?php if(isset($post)): ?><?php echo e($post->token); ?><?php else: ?><?php echo e($request->token); ?><?php endif; ?>">
                        </div>
                        <?php endif; ?>
                        <div class="col-sm-12 mx-3">
                            <input type="text" class="form-control tld-input" name="username" value="<?php if(isset($post)): ?><?php echo e($post->username); ?><?php endif; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 mx-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-12 mx-3">
                            <?php echo e($request->email); ?>

                            <input type="text" class="form-control tld-input" <?php if(isset($request->email)): ?> readonly <?php endif; ?> <?php if(isset($post->email)): ?>readonly <?php endif; ?> name="email" value="<?php if(isset($post)): ?><?php echo e($post->email); ?><?php else: ?><?php echo e($request->email); ?><?php endif; ?>">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-sm-12">  <input type="password" class="form-control tld-input" name="password"/></div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="confirm">Confirm password</label>
                            </div>
                           <div class="col-sm-12">
                               <input type="password" class="form-control tld-input" name="confirm">
                           </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12 mx-3 my-2">
                            <hr>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12"><label for="first_name">First Name </label></div>
                            <div class="col-sm-12"><input type="text"  name="first_name" class="form-control tld-input" value="<?php if(isset($post)): ?><?php echo e($post->first_name); ?><?php endif; ?>"></div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12"><label for="last_name">Last Name </label></div>
                            <div class="col-sm-12"><input type="text"  name="last_name" class="form-control tld-input" placeholder="" value="<?php if(isset($post)): ?><?php echo e($post->last_name); ?><?php endif; ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right my-2 mx-3">
                            <button class="g-recaptcha btn btn-primary"
                                    data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                    data-callback='onSubmit'
                                    data-action='register'>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>




























<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Register/index.blade.php ENDPATH**/ ?>