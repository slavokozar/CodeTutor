<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active"><?php echo e(trans('users.users.link')); ?></li>
    </ol>

    <h1><?php echo e(trans('users.users.heading')); ?></h1>

    <div id="content-nav-tabs">

        <ul class="nav nav-tabs">
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\SchoolController@index')); ?>" class="btn"><?php echo e(trans('users.schools.link')); ?></a>
            </li>

        </ul>

        <ul class="nav nav-tabs">
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\SchoolController@index')); ?>" class="btn"><?php echo e(trans('users.schools.link')); ?></a>
            </li>
            
                
            
        </ul>

    </div>
    <?php 
        $_table_action = function($userObj){
            return action('Users\UserController@show', [$userObj->code]);
        };
     ?>
    <?php echo $__env->make('users.partials.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>