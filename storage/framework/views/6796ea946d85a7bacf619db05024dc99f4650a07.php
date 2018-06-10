<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link') ]
        ]); ?>



    <h1><?php echo e(trans('assignments.heading')); ?></h1>

    <?php if(Auth::check() && Auth::user()->isAuthor()): ?>
    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Assignments\AssignmentController@create']
            ]
        ]); ?>

    <?php endif; ?>

    <section id="activities-list">

        <?php if(count($assignments) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('assignments.no-assignments'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignmentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $activityObj = $assignmentObj ?>
                <div class="activity">
                    <?php echo $__env->make('assignments.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo $assignments->render(); ?>

        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var sizes = [14, 18, 22, 26, 32];
        $('#sidebar span').each(function () {

            var size = $(this).data('size');

            $(this).css({
                'font-size': sizes[size]
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>