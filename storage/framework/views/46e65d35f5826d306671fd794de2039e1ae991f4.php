<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code],'label' => trans('users.students.link') ],
             [ 'label' => $userObj->name]
         ]); ?>


    <h1><?php echo e($userObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Schools\StudentController@edit', 'params' => [$schoolObj->code, $userObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Schools\StudentController@deleteModal', 'params' => [$schoolObj->code, $userObj->code]]
            ]
        ]); ?>


    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>