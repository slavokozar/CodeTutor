<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => trans('users.schools.link') ]
        ]); ?>


    <h1><?php echo e(trans('users.schools.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Users\Schools\SchoolController@create']
            ]
        ]); ?>


    <section id="list">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(trans('users.schools.labels.name')); ?></th>
                <th><?php echo e(trans('users.schools.labels.address')); ?></th>
                <th><?php echo e(trans('users.schools.labels.url')); ?></th>
                <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
                <th><i class="fa fa-user" data-toggle="tooltip" title="<?php echo e(trans('users.schools.labels.teachers')); ?>"
                       aria-hidden="true"></i></th>
                <th><i class="fa fa-graduation-cap" data-toggle="tooltip"
                       title="<?php echo e(trans('users.schools.labels.students')); ?>" aria-hidden="true"></i></th>

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
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>