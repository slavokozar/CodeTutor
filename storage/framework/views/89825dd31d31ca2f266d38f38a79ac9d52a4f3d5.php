<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
             [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
             [ 'action' => 'Users\Groups\TeacherController@index', 'params' => [$groupObj->code],'label' => trans('users.teachers.link') ],
             [ 'label' => $userObj->name]
         ]); ?>


    <h1><?php echo e($userObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.edit'), 'action' => 'Users\Groups\TeacherController@edit', 'params' => [$groupObj->code, $userObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Users\Groups\TeacherController@deleteModal', 'params' => [$groupObj->code, $userObj->code]]
            ]
        ]); ?>


    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>