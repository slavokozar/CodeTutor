<?php $__env->startSection('content'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $schoolObj->name ]
        ]); ?>



    <h1><?php echo e($schoolObj->name); ?></h1>

    <?php echo ContentNav::render([
            'left' => [
                ['label' => trans('users.admins.link'), 'action' => 'Users\Schools\AdminController@index', 'params' => [$schoolObj->code] ],
                ['label' => trans('users.teachers.link'), 'action' => 'Users\Schools\TeacherController@index', 'params' => [$schoolObj->code] ],
                ['label' => trans('users.students.link'), 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code] ],

            ],
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Schools\SchoolController@edit', 'params' => [$schoolObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Schools\SchoolController@create', 'params' => [$schoolObj->code]]
            ]
        ]); ?>



    <main role="main">
        <div class="row">
            <div class="col-md-20">
                <label for=""><?php echo e(trans('users.schools.labels.address')); ?></label>
            </div>
            <div class="col-md-40">
                <?php echo e($schoolObj->address); ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-20">
                <label for=""><?php echo e(trans('users.schools.labels.url')); ?></label>
            </div>
            <div class="col-md-40">
                <a href="<?php echo e($schoolObj->url); ?>" target="_blank"><?php echo e($schoolObj->url); ?></a>
            </div>
        </div>

    </main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>