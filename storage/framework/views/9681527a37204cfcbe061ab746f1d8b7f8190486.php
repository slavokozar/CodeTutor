<?php $__env->startSection('content-error'); ?>
    <h1>404</h1>
    <p class="text-center text-danger">
        <i class="fa fa-5x fa-exclamation-triangle" aria-hidden="true"></i>
        <br/>
        <?php echo $message; ?>

    </p>
    <?php if(isset($action) && isset($label)): ?>
        <p class="text-center"><?php echo e(trans('general.back-to')); ?> <a href="<?php echo $action; ?>"><?php echo e($label); ?></a></p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>