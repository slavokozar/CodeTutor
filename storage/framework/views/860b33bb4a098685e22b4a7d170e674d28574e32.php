<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code],'label' => trans('users.students.link') ],
        ];

        if($userObj->id){
            $breadcrumb[] = [ 'action' => 'Users\Schools\StudentController@show', 'params' => [$schoolObj->code, $userObj->code], 'label' => $userObj->name];
            $breadcrumb[] = [ 'label' => trans('users.students.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('users.students.create') ];
        }
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($userObj->id): ?>
        <h1><?php echo e($userObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('users.students.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($userObj->id == null){
            $_form_action = 'Users\Schools\StudentController@store';
            $_form_params = [$schoolObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Users\Schools\StudentController@update';
            $_form_params = [$schoolObj->code, $userObj->code];
            $_form_method = 'put';
        }
    ?>

    <?php echo $__env->make('users.partials.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>