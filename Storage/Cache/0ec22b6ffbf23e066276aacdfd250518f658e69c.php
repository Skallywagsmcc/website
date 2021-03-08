


<?php $__env->startSection("title"); ?>
    Admin Panel
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
        <div class="my-2 bg-light text-dark border border-dark">
            <h2>User manager</h2>
            <div><a href="/admin/users">List users</a></div>
            <div><a href="/admin/users/new">Create new users</a></div>
        </div>

        <div class="my-2 bg-light text-dark border border-dark">
            <h2>Blog manager</h2>
            <div><a href="/admin/blog">List Articles</a></div>
            <div><a href="/admin/blog/new">Create new Article</a></div>
            <div><a href="/admin/blog/gallery">Manager images</a></div>
        </div>


        <div class="my-2 bg-light text-dark border border-dark">
            <h2>Roles manager</h2>
            <div><a href="/admin/Roles">List Roles</a></div>
            <div><a href="/admin/Roles/new">Create new Role</a></div>
        </div>

        <div class="my-2 bg-light text-dark border border-dark">
            <h2>Settings</h2>
            <div><a href="/admin/settings">Manage Settings</a></div>
        </div>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Admin/index.blade.php ENDPATH**/ ?>