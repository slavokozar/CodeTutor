<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => $userObj->id ? $userObj->name : trans('users.users.create') ]
        ]); ?>



    <h1><?php echo e($userObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\UserController@edit', 'params' => [$userObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\UserController@deleteModal', 'params' => [$userObj->code]]
            ]
        ]); ?>


    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>