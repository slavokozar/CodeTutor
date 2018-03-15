<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li class="active"><?php echo e(trans('users.schools.link')); ?></li>
    </ol>

    <h1><?php echo e(trans('users.schools.heading')); ?></h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\SchoolController@create')); ?>" class="btn"><?php echo e(trans('general.buttons.create')); ?></a>
        </li>
        
        
        
    </ul>


    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('users.schools.labels.name')); ?></th>
            <th><?php echo e(trans('users.schools.labels.address')); ?></th>
            <th><?php echo e(trans('users.schools.labels.url')); ?></th>
            <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
            <th><i class="fa fa-user" data-toggle="tooltip" title="<?php echo e(trans('users.schools.labels.teachers')); ?>" aria-hidden="true"></i></th>
            <th><i class="fa fa-graduation-cap" data-toggle="tooltip" title="<?php echo e(trans('users.schools.labels.students')); ?>" aria-hidden="true"></i></th>

        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row">
                    <a href="<?php echo e(action('Users\Schools\SchoolController@show', [$schoolObj->code])); ?>"><?php echo e($schoolObj->code); ?></a>
                </th>
                <td>
                    <a href="<?php echo e(action('Users\Schools\SchoolController@show', [$schoolObj->code])); ?>"><?php echo e($schoolObj->name); ?></a>
                </td>
                <td><?php echo e($schoolObj->address); ?></td>
                <td>
                    <a href="<?php echo e($schoolObj->url); ?>" target="_blank"><?php echo e($schoolObj->url); ?></a>
                </td>
                <td>
                    <?php echo e($schoolObj->admins()->count()); ?>

                </td>
                <td>
                    <?php echo e($schoolObj->teachers()->count()); ?>

                </td>
                <td>
                    <?php echo e($schoolObj->students()->count()); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>