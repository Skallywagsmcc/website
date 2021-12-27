<?php
use App\Http\Controllers\SystemController;
$system = new SystemController();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC <?php echo $__env->yieldContent("title"); ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/css/custom/base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php echo $__env->yieldContent("head"); ?>
</head>
<body>
<?php echo $__env->make("Includes.Frontend.Navbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="app" class="container-wrapper px-0">

    <div class="container-fluid m-0 p-0">
        <div class=" d-none d-md-block logo_wrapper pb-3 pt-3 text-center">
            <img src="/img/logo.png" alt="Logo">
        </div>
        <div class=" container-fluid breadcrumbs my-2">
            <?php echo breadcrumbs(' > '); ?>

        </div>
        <?php echo $__env->yieldContent("content"); ?>

    </div>
</div>


<div class="row py-3 mx-0 footer">
    <div class="col-sm-12 col-md-4 text-center text-md-left">

        <?php echo e($_SERVER['APP_NAME']); ?> <?php echo e(date("Y")); ?>  &copy; : <?php echo e($system->readini("System","Version")); ?> | <a href="<?php echo $system->readini("System","Repo"); ?>"><?php echo e($system->readini("System","Repo_title")); ?></a>

        <?php $__currentLoopData = $system->parsefile(true,"Updates"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($key); ?>

            <?php echo e($value["Whats new"]); ?>

            <br>
            <?php echo e(str_replace("\n\n","<br>",$value["Content"])); ?>

        <?php echo e($value["Date"]); ?>

            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="col-sm-12 col-md-8 text-center px-0">
        <a href="<?php echo e($url->make("resources.home")); ?>">Useful Links</a>
    </div>
</div>

</body>
</html><?php /**PATH /var/www/html/public_html/Views/Layouts/main.blade.php ENDPATH**/ ?>