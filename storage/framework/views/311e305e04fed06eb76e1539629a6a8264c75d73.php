<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li class="active"><?php echo e($userObj->name); ?></li>
    </ol>

    <h1><?php echo e($userObj->name); ?></h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="<?php echo e(action('Users\UserController@edit', [$userObj->code])); ?>" class="btn"><?php echo e(trans('general.buttons.edit')); ?></a>
        </li>
        <li role="presentation">
            <a href="<?php echo e(action('Users\UserController@deleteModal', [$userObj->code])); ?>" class="btn btn-modal"><?php echo e(trans('general.buttons.delete')); ?></a>
        </li>
    </ul>




    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>