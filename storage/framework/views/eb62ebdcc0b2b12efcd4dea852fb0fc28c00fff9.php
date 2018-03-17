<?php $__env->startSection('wrapper'); ?>
    <div id="content" class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('wrapper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>