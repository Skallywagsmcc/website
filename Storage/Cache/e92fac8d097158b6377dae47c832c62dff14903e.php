
<?php $__env->startSection("content"); ?>

    <h2>Message : <?php if(isset($errmessage)): ?><?php echo e($errmessage); ?><?php endif; ?></h2>
        <?php if($requirments == true): ?>
            The Password Requirments are as follwes
            1  Upper case letter <br>
            1 lower case letter <br>
            1 number <br>
        <?php endif; ?>

        <form id="register" action="/auth/register" method="post">
            <input type="text" name="email" id="email" value="<?php echo e($user->email); ?>" placeholder="email address"><br><br>
            <input type="password" name="password" id="password"><br><br>
            <input type="password" name="confirm" id="confirm"><br><br>
            <button id="save">Register Account</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Register/index.blade.php ENDPATH**/ ?>