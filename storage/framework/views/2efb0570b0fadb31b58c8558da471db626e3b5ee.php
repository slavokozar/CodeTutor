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



    <section id="basic">
        <?php echo DataRender::render([
                [ 'label' => trans('users.groups.labels.name'), 'value' => $groupObj->name ],
                [ 'label' => trans('users.groups.labels.school'), 'value' => $groupObj->school ? $groupObj->school->name : '' ],
            ]); ?>

    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>