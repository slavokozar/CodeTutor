<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => trans('users.groups.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.groups.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Users\Groups\GroupController@create']
            ]
        ]); ?>



    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('users.groups.labels.name')); ?></th>
            <th><?php echo e(trans('users.groups.labels.school')); ?></th>
            <th><?php echo e(trans('users.groups.labels.public')); ?></th>
            <th><i class="fa fa-user" data-toggle="tooltip"
                   title="<?php echo e(trans('users.groups.labels.teachers')); ?>" aria-hidden="true"></i></th>
            <th><i class="fa fa-graduation-cap" data-toggle="tooltip"
                   title="<?php echo e(trans('users.groups.labels.students')); ?>" aria-hidden="true"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row">
                    <a href="<?php echo e(action('Users\Groups\GroupController@show', [$groupObj->code])); ?>"><?php echo e($groupObj->code); ?></a>
                </th>
                <td>
                    <a href="<?php echo e(action('Users\Groups\GroupController@show', [$groupObj->code])); ?>"><?php echo e($groupObj->name); ?></a>
                </td>
                <td><?php echo e($groupObj->school ? $groupObj->school->name : ''); ?></td>
                <td><?php echo $groupObj->is_public ? '<i class="fa fa-check" aria-hidden="true"></i>' : ''; ?></td>
                <td>
                    <?php echo e($groupObj->teachers()->count()); ?>

                </td>
                <td>
                    <?php echo e($groupObj->students()->count()); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>