<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => $userObj->id ? $userObj->name : trans('users.users.create') ]
        ]); ?>



    <h1><?php echo e($userObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\UserController@edit', 'params' => [$userObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\UserController@create', 'params' => [$userObj->code]]
            ]
        ]); ?>


    <?php echo $__env->make('users.partials.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <section id="schools">
        <h3><?php echo e(trans('users.schools.heading')); ?></h3>

        <?php $schools = $userObj->schools ?>
        <?php if($schools->count() > 0): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e($schoolObj->name); ?>

                        (<?php echo e(trans('users.schools.roles')[$schoolObj->pivot->role]); ?>)
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-schools')); ?></div>
        <?php endif; ?>
    </section>

    <section id="groups">
        <h3><?php echo e(trans('users.groups.heading')); ?></h3>

        <?php $groups = $userObj->groups ?>
        <?php if($groups->count() > 0): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e($groupObj->name); ?>

                        (<?php echo e(trans('users.groups.roles')[$groupObj->pivot->role]); ?>)
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-groups')); ?></div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>