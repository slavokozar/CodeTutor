<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
            [ 'label' => trans('users.teachers.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.teachers.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.add'), 'action' => 'Users\Groups\TeacherController@create', 'params' => [$groupObj->code], 'modal' => true]
            ]
        ]); ?>


    <?php
        $_table_skip['school'] = true;
        $_table_skip['groups'] = true;
        $_table_action = function($userObj) use ($groupObj){
            return action('Users\Groups\TeacherController@show', [$groupObj->code, $userObj->code]);
        };

        $_table_actions = [
            [
                'action' => function($userObj) use ($groupObj){
                    return action('Users\Groups\TeacherController@deleteModal', [$groupObj->code, $userObj->code]);
                },
                'label' => trans('general.remove'),
                'icon' => 'fa-trash',
                'modal' => true
            ]
        ]
    ?>

    <?php if(count($users) > 0): ?>
        <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <p class="text-center text-warning">
            <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            <br/>
            <?php echo e(trans('users.groups.no-teachers')); ?>

        </p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>