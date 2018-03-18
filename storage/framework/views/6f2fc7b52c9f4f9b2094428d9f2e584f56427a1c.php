<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\Schools\SchoolController@index')); ?>"><?php echo e(trans('users.schools.link')); ?></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\Schools\SchoolController@show', [$schoolObj->code])); ?>"><?php echo e($schoolObj->name); ?></a>
        </li>
        <li class="active"><?php echo e(trans('users.students.link')); ?></li>
    </ol>

    <h1><?php echo e(trans('users.students.heading')); ?></h1>

    <?php 
        $_table_skip['school'] = true;
        $_table_action = function($userObj) use ($schoolObj){
            return action('Users\Schools\StudentController@show', [$schoolObj->code, $userObj->code]);
        };
     ?>
    <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>