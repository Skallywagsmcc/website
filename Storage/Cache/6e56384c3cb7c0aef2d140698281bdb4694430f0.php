


<?php $__env->startSection("content"); ?>
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            <?php echo $__env->make("Includes.AccountNav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Upload a profile picture
                </div>

                <form action="/account/edit/picture" method="post" enctype="multipart/form-data">
                    <input type="file" name="upload">
                    <button>Upload</button>
                </form>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Frontend/Account/Picture.blade.php ENDPATH**/ ?>