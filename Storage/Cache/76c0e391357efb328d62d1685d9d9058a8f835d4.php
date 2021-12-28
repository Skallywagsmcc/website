

<?php $__env->startSection("title"); ?>
    Admin Panel : list users
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
        <div class="row box m-1 d-lg-none">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="<?php echo e($url->make("auth.admin.home")); ?>">Back to admin home</a>
            </div>
        </div>

        <div class="row box m-1">
            <div class="col-sm-12">
                <form action="<?php echo e($url->make("auth.admin.users.search")); ?>" class="tld-form ">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-9 my-3">
                            <input type="search" class="form-control tld-input" name="keyword" placeholder="Search for a user">
                        </div>
                        <div class="col-sm-12 col-md-3 my-3 ">
                            <button class="btn btn-block btn-dark">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>





    <div class="row m-1">
        <div class="col-sm-12 text-md-right text-center py-2 new">
            <a href="<?php echo e($url->make("auth.admin.users.new")); ?>" class="p-2">Create a New User</a>
        </div>
    </div>

    <div class="container">
        <div class="row px-0">
            <div class="col-sm-12 col-md-3">
                <div class="col-sm-12 box px-0">
                    <div class="head">Newest Accounts</div>
                    <?php $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 text-center">
                            <?php echo e($u->username); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
            <div class=" col-sm-12 col-md-9 box px-0">
                <div class="col-sm-12 px-0">
                    <div class="head">Profiles</div>
                    <div class="row my-2">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-12 col-md-4 text-center">
                                <div class="col-sm-12 px-0">
                                    <?php if((is_null($user->Profile->profile_pic)) ||(!file_exists("./img/uploads/".$user->Profile->image->name)) ): ?>
                                        <img class="" src="/img/logo.png" alt="<?php echo e($user->Profile->image->title); ?>"
                                             height="200" width="200"/>
                                    <?php else: ?>
                                        <img class="" src="/img/uploads/<?php echo e($user->Profile->image->name); ?>"
                                             alt="<?php echo e($user->Profile->image->title); ?>" height="200" width="200"/>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-12 px-0  my-2 py-2 text-center">
                                    <a href="<?php echo e($url->make("auth.admin.users.edit",["id"=>base64_encode($user->id)])); ?>"
                                       class="d-block">Manage <?php echo e($user->username); ?></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php if($settings->where("open_registration",0)->count()==1): ?>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">Manager User Requests</div>
        </div>
            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row box my-2 text-center">
                    <div class="col-sm-12 col-lg-6 py-2"><?php echo e($request->email); ?></div>
                    <div class="col-sm-12 col-lg-3 py-2">Email Account request</div>
                    <div class="col-sm-12 col-lg-3 py-2">Delete Request</div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/AdminCp/Users/index.blade.php ENDPATH**/ ?>