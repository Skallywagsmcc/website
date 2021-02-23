
<?php $__env->startSection("content"); ?>
    <h2>Registration : Enter Your email</h2>
    <div class="row my-2">
        <form id="register" action="/auth/register" method="post">
            

            <input type="text" name="email" id="email" placeholder="email address"><br><br>



            <button id="save">Save</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Auth/Register.blade.php ENDPATH**/ ?>