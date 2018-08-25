<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('users.users.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.users.heading')); ?></h1>

    <?php echo ContentNav::render([
            'left' => [
                ['label' => trans('users.schools.heading'), 'action' => 'Users\Schools\SchoolController@index'],
                ['label' => trans('users.groups.heading'), 'action' => 'Users\Groups\GroupController@index']
            ],
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Users\UserController@create']
            ]
        ]); ?>

       
    <?php
        $_table_action = function($userObj){
            return action('Users\UserController@show', [$userObj->code]);
        };
    ?>
    <section id="list">
        <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>