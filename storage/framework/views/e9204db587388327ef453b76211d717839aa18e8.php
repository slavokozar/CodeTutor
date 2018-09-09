<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],

             [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
             [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
             [ 'label' => trans('users.students.create') ],
        ];
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <h1><?php echo e(trans('users.students.create')); ?></h1>

    <?php
        $_form_action = 'Users\Schools\StudentController@store';
        $_form_params = [$groupObj->code];
        $_form_method = 'post';

        $userObj = new \App\Models\Users\User();
    ?>

    <?php echo $__env->make('users.partials.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>