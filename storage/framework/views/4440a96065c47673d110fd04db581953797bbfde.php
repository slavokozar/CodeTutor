<?php $__env->startSection('content'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $schoolObj->name ]
        ]); ?>



    <h1><?php echo e($schoolObj->name); ?></h1>

    <div class="subnavigation clearfix">
        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\AdminController@index', [$schoolObj->code])); ?>"
                   class="btn"><?php echo e(trans('users.admins.link')); ?></a>
            </li>
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\TeacherController@index', [$schoolObj->code])); ?>"
                   class="btn"><?php echo e(trans('users.teachers.link')); ?></a>
            </li>
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\StudentController@index', [$schoolObj->code])); ?>"
                   class="btn"><?php echo e(trans('users.students.link')); ?></a>
            </li>
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\SchoolController@edit', [$schoolObj->code])); ?>"
                   class="btn"><?php echo e(trans('general.buttons.edit')); ?></a>
            </li>
            <li role="presentation">
                <a href="<?php echo e(action('Users\Schools\SchoolController@deleteModal', [$schoolObj->code])); ?>"
                   class="btn btn-modal"><?php echo e(trans('general.buttons.delete')); ?></a>
            </li>
        </ul>
    </div>

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