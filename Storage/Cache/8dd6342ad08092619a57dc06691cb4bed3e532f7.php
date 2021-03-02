<form action="/auth/reset-password/request">
    <input type="text" name="id" value="<?php echo e($id); ?>"><br><br>
    <input type="text" name="hex" value="<?php echo e($hex); ?>"><br><br>

    <input type="password" name="password"> <br><br>
    <input type="password" name="confirm"><br><br>
    <button>Save</button>
</form><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/PasswordReset/newpassword.blade.php ENDPATH**/ ?>