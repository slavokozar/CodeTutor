<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li class="active"><?php echo e($userObj->name); ?></li>
    </ol>

    <h1><?php echo e($userObj->name); ?></h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="<?php echo e(action('Users\UserController@edit', [$userObj->code])); ?>" class="btn"><?php echo e(trans('general.buttons.edit')); ?></a>
        </li>
        <li role="presentation">
            <a href="<?php echo e(action('Users\UserController@deleteModal', [$userObj->code])); ?>" class="btn btn-modal"><?php echo e(trans('general.buttons.delete')); ?></a>
        </li>
    </ul>

    <main role="main">

        <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <section id="schools">
            <h3><?php echo e(trans('users.schools.heading')); ?></h3>

            <?php  $schools = $userObj->schools  ?>
            <?php if($schools->count() > 0): ?>
                <ul class="list-group">
                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e($schoolObj->name); ?> (<?php echo e(trans('users.schools.roles')[$schoolObj->pivot->role]); ?>)</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-schools')); ?></div>
            <?php endif; ?>
        </section>

        <section id="groups">
            <h3><?php echo e(trans('users.groups.heading')); ?></h3>

            <?php  $groups = $userObj->groups  ?>
            <?php if($groups->count() > 0): ?>
                <ul class="list-group">
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e($groupObj->name); ?> (<?php echo e(trans('users.groups.roles')[$groupObj->pivot->role]); ?>)</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-groups')); ?></div>
            <?php endif; ?>
        </section>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>