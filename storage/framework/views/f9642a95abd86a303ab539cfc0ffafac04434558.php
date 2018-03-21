<?php if(session()->has('flash_notification.message')): ?>
    <div class="container">
        <div id="flash">
            <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
                <?php echo session('flash_notification.message'); ?>

            </div>
        </div>
    </div>
<?php endif; ?>