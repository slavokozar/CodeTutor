<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
        [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
        [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
        [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
        [ 'label' => trans('assignments.' . $data . '.link'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@index',  'params' => [$assignmentObj->code]],
        [ 'label' => trans('assignments.' . $data . '.heading') . ' #' . $testdataObj->number]
    ]); ?>


    <h1><?php echo e(trans('assignments.' . $data . '.heading') . ' #' . $testdataObj->number); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.edit'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@edit', 'params' => [$assignmentObj->code, $testdataObj->number]],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@deleteModal', 'params' => [$assignmentObj->code, $testdataObj->number]]
            ]
        ]); ?>


    <section>


    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>