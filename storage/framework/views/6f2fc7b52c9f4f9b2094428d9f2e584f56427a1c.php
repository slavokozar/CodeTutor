<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
            [ 'label' => trans('users.students.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.students.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Users\Schools\StudentController@create']
            ]
        ]); ?>


    <?php
        $_table_skip['school'] = true;
        $_table_action = function($userObj) use ($schoolObj){
            return action('Users\Schools\StudentController@show', [$schoolObj->code, $userObj->code]);
        };
    ?>
    <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>