<?php $__env->startSection('content-main'); ?>
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



    <section id="basic">
        <?php echo DataRender::render([
                ['label'=>'#', 'value'=>$schoolObj->code],
                ['label'=>trans('users.schools.labels.address'), 'value'=>$schoolObj->address],
                ['label'=>trans('users.schools.labels.url'), 'value'=>$schoolObj->url],
            ]); ?>

    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>