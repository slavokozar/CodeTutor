<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
            [ 'label' => trans('users.students.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.students.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.add'), 'action' => 'Users\Groups\StudentController@create', 'params' => [$groupObj->code], 'modal' => true]
            ]
        ]); ?>


    <?php
        $_table_skip['school'] = true;
        $_table_skip['group'] = true;
        $_table_action = function($userObj) use ($groupObj){
            return action('Users\Groups\StudentController@show', [$groupObj->code, $userObj->code]);
        };
    ?>

    <?php if(count($users) > 0): ?>
        <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <p class="text-center text-warning">
            <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            <br/>
            <?php echo e(trans('users.groups.no-students')); ?>

        </p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>