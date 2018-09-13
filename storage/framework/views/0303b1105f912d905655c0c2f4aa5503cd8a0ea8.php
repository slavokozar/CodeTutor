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
                ['label' => trans('general.create'), 'action' => 'Users\Schools\StudentController@create', 'params' => [$schoolObj->code]]
            ]
        ]); ?>


    <?php
        $_table_skip['school'] = true;
        $_table_action = function($userObj) use ($schoolObj){
            return action('Users\Schools\StudentController@show', [$schoolObj->code, $userObj->code]);
        };
    ?>

    <?php if(count($users) > 0): ?>
        <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <p class="text-center text-warning">
            <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            <br/>
            <?php echo e(trans('users.schools.no-students')); ?>

        </p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>