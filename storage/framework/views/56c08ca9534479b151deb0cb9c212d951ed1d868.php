<?php $__env->startSection('content-main'); ?>
    <section id="activities-list">
        <h1>Activity feed</h1>

        <?php if(count($activities) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('articles.articles.no-articles'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="activity">

                    <?php if($activityObj->object_type == 'article'): ?>
                        <?php $articleObj = $activityObj->object() ?>

                        <div class="activity-image">
                            <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                        </div>

                        <div class="activity-content">
                            <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">
                                <h2><?php echo e($articleObj->name); ?></h2>
                            </a>
                            <div class="activity-info">
                                <div class="activity-detail">
                                    <div class="activity-author">
                                        <?php echo e(trans('activities.from-user')); ?>

                                        <?php echo e($articleObj->author->name); ?>

                                    </div>
                                    <div class="activity-sharing">
                                        <?php if( $activityObj->school != null): ?>
                                            <?php echo e(trans('activities.shared-in-school')); ?>

                                            <?php echo e($activityObj->school->name); ?>

                                        <?php elseif( $activityObj->group != null): ?>
                                            <?php echo e(trans('activities.shared-in-group')); ?>

                                            <?php echo e($activityObj->group->name); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="activity-date"><?php echo e($articleObj->updated_at); ?></div>
                            </div>
                            <div class="activity-description">
                                <?php echo $articleObj->description; ?>

                                <a class="read-more"
                                   href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>"><?php echo e(trans('articles.articles.read-more')); ?></a>
                            </div>
                        </div>

                    <?php elseif($activityObj->object_type == 'assignment'): ?>

                    <?php endif; ?>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>