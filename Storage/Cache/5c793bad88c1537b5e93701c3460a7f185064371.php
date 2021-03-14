

<?php if(\App\Http\Libraries\Authentication\Auth::id() == $user->id): ?>
    <hr>
    <div><a href="/<?php echo e($user->username); ?>/tools/manage/profile">Edit Profile</a></div>
    <div><a href="/<?php echo e($user->username); ?>/tools/manage/articles">Manage my Articles</a></div>
    <div><a href="/<?php echo e($user->username); ?>/tools/manage/account">My Account</a></div>
    <div><a href="/<?php echo e($user->username); ?>/tools/moderate">Administrator Tools</a></div>
<?php endif; ?>
<?php /**PATH /var/www/html/public_html/Views/Includes/ProfileNav.blade.php ENDPATH**/ ?>