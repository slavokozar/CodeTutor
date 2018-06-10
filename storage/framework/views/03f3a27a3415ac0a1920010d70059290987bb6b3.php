<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link') ]
        ]); ?>



    <h1><?php echo e(trans('assignments.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Assignments\AssignmentController@create']
            ]
        ]); ?>


    <section id="activities-list">

        <?php if(count($assignments) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('assignments.no-assignments'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignmentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="activity <?php echo e($assignmentObj->is_public ? '' : 'private'); ?>">

                    <div class="activity-image">
                        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                    </div>
                    <div class="activity-content">
                        <a href="<?php echo e(action('Assignments\AssignmentController@show',[$assignmentObj->code])); ?>">
                            <h2><?php echo e($assignmentObj->name); ?></h2>
                        </a>
                        <div class="activity-details">
                            <span class="activity-author"><?php echo e(trans('feed.from-user')); ?> <?php echo e($assignmentObj->author->name); ?></span>

                            <?php if($assignmentObj->group != null): ?><span
                                    class="activity-group"><?php echo e(trans('feed.in-group')); ?> <?php echo e($assignmentObj->group->name); ?></span><?php endif; ?>
                            <span class="activity-date"><?php echo e($assignmentObj->updated_at); ?></span>
                        </div>
                        <p class="activity-description">
                            <?php echo $assignmentObj->description; ?>

                            <a class="read-more"
                               href="<?php echo e(action('Assignments\AssignmentController@show',[$assignmentObj->code])); ?>"><?php echo e(trans('assignments.read-more')); ?></a>
                        </p>
                    </div>
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