<?php $__env->startSection('content-main'); ?>
    <section id="activities-list">

        <h1 style="margin-top: 5rem;"><?php echo e(trans('feed.heading')); ?></h1>

        <?php if( Auth::check() && Auth::user()->isAdmin()): ?>
            <?php echo ContentNav::render([
                    'right' => [
                        ['label' => trans('general.create'), 'id' => 'create-content']
                    ]
                ]); ?>


            <div class="row">
                <div class="col-md-20 text-center">
                    <?php echo e(trans('links.add')); ?>

                    Pridat odkaz
                </div>
                <div class="col-md-20 text-center">
                    <?php echo e(trans('files.add')); ?>

                </div>
                <div class="col-md-20 text-center">
                    <?php echo e(trans('articles.add')); ?>

                </div>
                <div class="col-md-20 text-center">
                    
                    <?php echo e(trans('assignment.add')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(count($activities) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('articles.no-articles'); ?></p>
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
                                        <strong><?php echo e(trans('articles.single')); ?></strong>
                                        <?php echo e(trans('feed.from-user')); ?>

                                        <strong><?php echo e($articleObj->author->fullName()); ?></strong>
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
                                <div class="activity-date"><?php echo e($articleObj->updated_at); ?></div>
                            </div>
                            <div class="activity-description">
                                <?php echo $articleObj->description; ?>

                                <a class="read-more"
                                   href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>"><?php echo e(trans('feed.read-more')); ?></a>
                            </div>
                        </div>

                    <?php elseif($activityObj->object_type == 'assignment'): ?>
                        <?php $assignmentObj = $activityObj->object() ?>


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
                    <?php endif; ?>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if( Auth::check() && Auth::user()->isAdmin()): ?>
        <script>
            $(function () {
                $('#create-content').click(function (e) {
                    e.preventDefault();

                    console.log('show buttons');
                })
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>