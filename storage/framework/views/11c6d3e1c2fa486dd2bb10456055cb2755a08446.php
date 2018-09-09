<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => $userObj->id ? $userObj->name : trans('users.users.create') ]
        ]); ?>


    <?php if($userObj->id): ?>
        <h1><?php echo e($userObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('users.users.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($userObj->id == null){
            $_form_action = 'Users\UserController@store';
            $_form_params = [];
            $_form_method = 'post';
        }else{
            $_form_action = 'Users\UserController@update';
            $_form_params = [$userObj->code];
            $_form_method = 'put';
        }
    ?>

    <?php echo $__env->make('users.partials.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>