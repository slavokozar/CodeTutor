<?php $__env->startSection('content'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $groupObj->name ]
        ]); ?>



    <h1><?php echo e($groupObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Groups\GroupController@edit', 'params' => [$groupObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Groups\GroupController@create', 'params' => [$groupObj->code]]
            ]
        ]); ?>



    <main role="main">
        <div class="row">
            <div class="col-md-20">
                <label for=""><?php echo e(trans('users.groups.labels.name')); ?></label>
            </div>
            <div class="col-md-40">
                <?php echo e($groupObj->name); ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-20">
                <label for=""><?php echo e(trans('users.groups.labels.school')); ?></label>
            </div>
            <div class="col-md-40">
                <?php echo e($groupObj->school->name); ?>

            </div>
        </div>

    </main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>