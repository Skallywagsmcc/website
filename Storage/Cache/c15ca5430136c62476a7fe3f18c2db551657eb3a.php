


<?php $__env->startSection("head"); ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("password-reset-form").submit();
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
                    
                    <?php if($value->count == true): ?>
                        <?php if(date("d/m/Y H:i:s") < date("d/m/Y H:i:s",strtotime($value->request->first()->expires))): ?>
                            <div class="col-sm-12 head">Reset Password: Request Found</div>

                            <form action="<?php echo e($url->make("passwordreset.update",["token_hex"=>$value->token_hex])); ?>" method="post" class="tld-form" id="password-reset-form">
                                <input type="hidden" name="token_hex" readonly value="<?php echo e($token_hex); ?>">
                                <div class="form-group px-0">
                                    <label for="">New Password </label>
                                    <div class="col-sm-12 my-1"><input type="password" class="tld-input form-control"
                                                                       name="password"></div>
                                </div>

                                <div class="form-group px-0">
                                    <label for="">Confirm New Password </label>
                                    <div class="col-sm-12 my-1"><input type="password" class="tld-input form-control"
                                                                       name="confirm"></div>

                                </div>

                                <div class="form-group px-0">
                                    <label for="">Token Key (this was emailed to you)</label>
                                    <div class="col-sm-12"><input type="text" class="form-control tld-input"
                                                                  name="token_key"  <?php if(isset($value->token_key)): ?> value="<?php echo e($value->token_key); ?>"<?php endif; ?> placeholder="token_key"></div>
                                </div>


                                <div class="col-sm-12">
                                    <button class="g-recaptcha btn btn-block tld-button my-2"
                                            data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                            data-callback='onSubmit'
                                            data-action='password_reset'>Reset Password
                                    </button>
                                </div>
                            </form>
                        <?php else: ?>
                        <div class="col-sm-12 head">An Error Occurred</div>
                            <div class="col-sm-12 text-center">The Current Password Request has Expired Please make a new one</div>
                        <?php endif; ?>

                        
                    <?php else: ?>
                        <div class="col-sm-12 head">An Error Occurred</div>
                        <div class="col-sm-12">Sorry it seems the request you are looking for has been deleted</div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="col-sm-12 head">More Help</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>




























































<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/PasswordReset/request.blade.php ENDPATH**/ ?>