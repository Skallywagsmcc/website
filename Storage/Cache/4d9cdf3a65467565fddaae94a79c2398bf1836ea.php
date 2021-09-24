<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC <?php echo $__env->yieldContent("title"); ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
    <script src="/Assets/js/Backend/ckeditor.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head
<body>
















<?php echo $__env->make("Includes.Backend.Nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    use mbamber1986\Authclient\Auth;
    $auth = new Auth();
?>

<div  class="container-fluid text-center text-md-left my-3 py-2" id="account_bar">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?php if(\App\Http\Models\Profile::where("user_id",$auth->id())->get()->first()->profile_pic == null): ?>
                <img src="/img/logo.png" alt="Logo" class="profile_pic">
                <?php echo e($auth->getusername()); ?>

            <?php else: ?>
                <img src="/img/uploads/<?php echo e(\App\Http\Models\User::find($auth->id())->Profile->Image->name); ?>" alt="<?php echo e($image->name); ?>" class="profile_pic">
                <?php echo e($auth->getusername()); ?>

            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-md-6">Your Last Login was : <?php echo e(LastLogin()); ?></div>
    </div>
</div>
<div id="content-wrapper" class="p-0">
    <?php echo $__env->yieldContent("content"); ?>
</div>

<div class="row footer mx-0">
    <div class="col-sm-12">UCP <?php echo e(date("Y")); ?> by Martin </div>
</div>


</body>
</html><?php /**PATH /var/www/html/public_html/Views/Layouts/backend.blade.php ENDPATH**/ ?>