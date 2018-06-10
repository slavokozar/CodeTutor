<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('assignments.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('assignments.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row">
        <div class="col-md-60 text-center">
            <h3>Chcete naozaj vymazat zadanie: <strong><?php echo e($assignmentObj->name); ?></strong>?</h3>
            <form action="<?php echo e(action('Assignments\AssignmentController@delete',[$assignmentObj->code])); ?>" method="post">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="_method" value="delete">
                <a href="<?php echo e(action('Assignments\AssignmentController@show',[$assignmentObj->code])); ?>" class="btn btn-default">Zrušiť</a>
                <button type="submit" class="btn btn-danger">Vymazať</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>