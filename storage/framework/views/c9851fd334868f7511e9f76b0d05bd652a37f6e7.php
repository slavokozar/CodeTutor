<?php if(session()->has('flash_notification.message')): ?>
    <div id="flash">
        <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
            <?php echo session('flash_notification.message'); ?>

        </div>
    </div>
<?php endif; ?>