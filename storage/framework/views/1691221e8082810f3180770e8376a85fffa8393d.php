<!DOCTYPE html>
<html>
<head>
    <?php echo $__env->make('layouts.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/shCore.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/shThemeDefault.css')); ?>">

    <link rel="shortcut icon" href="<?php echo e(asset('img/codeleague.ico')); ?>" type="image/x-icon">
</head>
<body>
    <?php echo $__env->make('layouts.partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>