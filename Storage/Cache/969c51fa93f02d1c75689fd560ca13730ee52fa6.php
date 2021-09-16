

<?php $__env->startSection("title"); ?>
    Contact us
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <?php if(isset($error)): ?>
            <?php if($error == "required"): ?>
                <?php $__currentLoopData = $validate::$values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    Missing Value :: <?php echo e($value); ?> <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo e($error); ?>

            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <form action="<?php echo e($url->make("contact-store")); ?>" class="tld-form" method="post">
                    <div class="row">
                        <div class="col-sm-12 head">Contact us</div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="text" class="form-control tld-input" name="email" value="<?php if(isset($validate)): ?><?php echo e($validate->Post("email")); ?><?php endif; ?>">
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="">First Name :</label>
                            <input type="text" class="form-control tld-input" name="first_name" value="<?php if(isset($validate)): ?><?php echo e($validate->Post("first_name")); ?><?php endif; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Last Name :</label>
                            <input type="text" class="form-control tld-input" name="last_name" value="<?php if(isset($validate)): ?><?php echo e($validate->Post("last_name")); ?><?php endif; ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="subject">Club Name if Applicable</label>
                        <input type="text" class="form-control tld-input" name="club" value="<?php if(isset($validate)): ?><?php echo e($validate->Post("club")); ?><?php endif; ?>">
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control tld-input" name="subject" value="<?php if(isset($validate)): ?><?php echo e($validate->Post("subject")); ?><?php endif; ?>">
                    </div>


                    <div class="form-group">
                        <label for="message">Your Message </label>
                        <textarea id="message" name="message" class="form-control tld-input"><?php if(isset($validate)): ?><?php echo e($validate->Post("message")); ?><?php endif; ?></textarea>
                    </div>




                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-7 py-2 text-right">
                            <input type="hidden" name="sum1" value="<?php echo e($sum1); ?>">
                            <input type="hidden" name="sum2" value="<?php echo e($sum2); ?>">
                            <label for="sum">What is : <?php echo e($sum1); ?> + <?php echo e($sum2); ?> ?</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-5 text-left">
                            <input type="text" class="form-control tld-input" name="total">
                        </div>


                    </div>

                    <button class="btn tld-button btn-block">Send message</button>
                </form>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Contact/index.blade.php ENDPATH**/ ?>