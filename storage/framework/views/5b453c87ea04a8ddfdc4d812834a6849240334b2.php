<?php $__env->startSection('content-main'); ?>
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
            <a href="<?php echo e(action('Users\Schools\SchoolController@show', [$schoolObj->code  ])); ?>"><?php echo e($schoolObj->name); ?></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\Schools\StudentController@index', [$schoolObj->code  ])); ?>"><?php echo e(trans('users.students.link')); ?></a>

        </li>
        <li class="active"><?php echo e($userObj->name); ?></li>
    </ol>

    <h1><?php echo e($userObj->name); ?></h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\StudentController@edit', [$schoolObj->code, $userObj->code])); ?>" class="btn"><?php echo e(trans('general.buttons.edit')); ?></a>
        </li>
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\StudentController@deleteModal', [$schoolObj->code, $userObj->code])); ?>" class="btn"><?php echo e(trans('general.buttons.delete')); ?></a>
        </li>
    </ul>

    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>