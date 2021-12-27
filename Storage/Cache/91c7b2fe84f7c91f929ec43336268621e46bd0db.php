


<?php $__env->startSection("head"); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("password-request-form").submit();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>

    <?php if(isset($value->error)): ?>
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 head">An Error Occurred</div>
                <div class="col-sm-12">
                    <?php echo e($value->error); ?>

                    <br><br>
                    <?php if(isset($value->required)): ?>
                        <?php $__currentLoopData = $value->required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $required): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($required); ?> <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>


            </div>
        </div>

    <?php endif; ?>

    <?php if(isset($value)): ?>
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <?php if($value->status == false): ?>
                        
                        <div class="col-sm-12 head">Password Reset : New Request</div>
                        <form action="<?php echo e($url->make("passwordreset.store")); ?>" method="post" class="tld-form"
                              id="password-request-form">
                            <div class="form-group">
                                <label for="emaik">Your Email Address</label>
                                <div class="col-sm-12 py-2">
                                    <input type="text" name="email" class="form-control tld-input">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="g-recaptcha btn btn-block tld-button my-2"
                                        data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                        data-callback='onSubmit'
                                        data-action='password_request'>Send Request
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="col-sm-12 head">What happens?</div>
                        <div class="col-sm-12 text-center">
                            Thank you for submitting your request for a new password. <br>
                            for your security we have sent you instructions to your registered mail account explaining what you need to do next.
                            <hr>
                            step 1 : Go to your inbox of your registered email account. <br>
                            step 2 : click on the link we have provided to take you to the required page. <hr>
                            Note : Please check your junk folder for these emails as free emails providers such as outlook mark them as spam.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="col-sm-12 head">More Help</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/PasswordReset/index.blade.php ENDPATH**/ ?>