<div class="activity-image">
    <span class="fa fa-graduation-cap" aria-hidden="true"></span>
</div>

<div class="activity-content">
    <a href="<?php echo e(action('Assignments\AssignmentController@show',[$assignmentObj->code])); ?>">
        <h2><?php echo e($assignmentObj->name); ?></h2>
    </a>
    <div class="activity-info">
        <div class="activity-detail">
            <div class="activity-author">
                <strong><?php echo e(trans('assignments.single')); ?></strong>
                <?php echo e(trans('feed.from-user')); ?>

                <strong><?php echo e($assignmentObj->author->fullName()); ?></strong>
            </div>
            <div class="activity-sharing">
                <?php if( $activityObj->school != null): ?>
                    <?php echo e(trans('feed.shared-in-school')); ?>

                    <strong><?php echo e($activityObj->school->name); ?></strong>
                <?php elseif( $activityObj->group != null): ?>
                    <?php echo e(trans('feed.shared-in-group')); ?>

                    <strong><?php echo e($activityObj->group->name); ?></strong>
                <?php endif; ?>
            </div>
        </div>
        <div class="activity-date"><?php echo e($assignmentObj->updated_at); ?></div>
    </div>
    <div class="activity-description">
        <?php echo $assignmentObj->description; ?>

        <a class="read-more"
           href="<?php echo e(action('Assignments\AssignmentController@show',[$assignmentObj->code])); ?>"><?php echo e(trans('feed.read-more')); ?></a>
    </div>
</div>