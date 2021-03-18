

<?php if(\App\Http\Libraries\Authentication\Auth::id() == $user->id): ?>
    <hr>
    <div><a href="/profile/<?php echo e($user->username); ?>/gallery">Gallery</a></div>
<?php endif; ?>
<?php /**PATH /var/www/html/public_html/Views/Includes/ProfileNav.blade.php ENDPATH**/ ?>