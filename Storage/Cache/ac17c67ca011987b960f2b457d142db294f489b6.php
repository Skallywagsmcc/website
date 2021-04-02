

Hello <?php echo e($user->Profile->first_name); ?>}<br>
here is your Two Factor Authentication code <?php echo e($code); ?>




Skallywags &copy;
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Emails/Tfa.blade.php ENDPATH**/ ?>