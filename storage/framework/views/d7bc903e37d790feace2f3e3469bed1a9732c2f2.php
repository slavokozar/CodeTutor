<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'label' => $groupObj->name ]
        ]); ?>



    <h1><?php echo e($groupObj->name); ?></h1>

    <?php echo ContentNav::render([
            'left' => [
                ['label' => trans('users.teachers.link'), 'action' => 'Users\Groups\TeacherController@index', 'params' => [$groupObj->code] ],
                ['label' => trans('users.students.link'), 'action' => 'Users\Groups\StudentController@index', 'params' => [$groupObj->code] ],

            ],
            'right' => [
                ['label' => trans('general.edit'), 'action' => 'Users\Groups\GroupController@edit', 'params' => [$groupObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Users\Groups\GroupController@create', 'params' => [$groupObj->code]]
            ]
        ]); ?>



    <section id="basic" class="show-section">
        <h2><?php echo e(trans('general.basic-info')); ?></h2>
        <?php echo DataRender::render([
                [ 'label' => trans('users.groups.labels.name'), 'value' => $groupObj->name ],
                [ 'label' => trans('users.groups.labels.school'), 'value' => $groupObj->school ? $groupObj->school->name : '' ],
            ]); ?>

    </section>

    <section id="teachers" class="show-section">
        <h2><?php echo e(trans('users.teachers.heading')); ?></h2>

        <?php if($groupObj->teachers->count() > 0): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $groupObj->teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(action('Users\Groups\TeacherController@show', [$groupObj->code, $teacherObj->code])); ?>">
                        <?php echo e($teacherObj->fullName()); ?>

                        </a>
                        
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info" role="alert"><?php echo e(trans('users.groups.no-teachers')); ?></div>
        <?php endif; ?>

        <div class="text-center">
            <a class="btn btn-sm btn-danger btn-modal" href="<?php echo e(action('Users\Groups\TeacherController@add', [$groupObj->code])); ?>">
                <?php echo e(trans('users.teachers.add')); ?>

            </a>
        </div>
    </section>


    <section id="students" class="show-section">
        <h2><?php echo e(trans('users.students.heading')); ?></h2>

        <?php if($groupObj->students->count() > 0): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $groupObj->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(action('Users\Groups\StudentController@show', [$groupObj->code, $teacherObj->code])); ?>">
                        <?php echo e($studentObj->fullName()); ?>


                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert"><?php echo e(trans('users.groups.no-students')); ?></div>
        <?php endif; ?>

        <div class="text-center">
            <a class="btn btn-sm btn-danger btn-modal" href="<?php echo e(action('Users\Groups\StudentController@add', [$groupObj->code])); ?>">
                <?php echo e(trans('users.students.add')); ?>

            </a>
        </div>
    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>