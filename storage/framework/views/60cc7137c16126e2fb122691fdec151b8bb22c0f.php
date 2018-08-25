<?php $__env->startSection('content-main'); ?>
    <section id="activities-list">

        <h1 style="margin-top: 5rem;"><?php echo e(trans('feed.heading')); ?></h1>

        <?php if( Auth::check() && Auth::user()->isAuthor()): ?>

            <div id="feed-add-content">
                <div>
                    <a href="<?php echo e(action('Links\LinkController@create')); ?>">
                        <span class="fa fa-link" aria-hidden="true"></span>
                        <div class="label"><?php echo e(trans('links.add')); ?></div>
                    </a>
                </div>
                <div>
                    <a href="<?php echo e(action('Files\FileController@create')); ?>">
                        <span class="fa fa-file-o" aria-hidden="true"></span>
                        <div class="label"><?php echo e(trans('files.add')); ?></div>
                    </a>
                </div>
                <div>
                    <a href="<?php echo e(action('Articles\ArticleController@create')); ?>">
                        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                        <div class="label"><?php echo e(trans('articles.add')); ?></div>
                    </a>
                </div>
                <div>
                    <a href="<?php echo e(action('Assignments\AssignmentController@create')); ?>">
                        <span class="fa fa-graduation-cap" aria-hidden="true"></span>
                        <div class="label"><?php echo e(trans('assignments.add')); ?></div>
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($activities) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('feed.no-activity'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="activity">
                    <?php if($activityObj->object_type == 'link'): ?>
                        <?php $linkObj = $activityObj->object() ?>
                        <?php echo $__env->make('links.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php elseif($activityObj->object_type == 'file'): ?>
                        <?php $fileObj = $activityObj->object() ?>
                        <?php echo $__env->make('files.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php elseif($activityObj->object_type == 'article'): ?>
                        <?php $articleObj = $activityObj->object() ?>
                        <?php echo $__env->make('articles.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php elseif($activityObj->object_type == 'assignment'): ?>
                        <?php $assignmentObj = $activityObj->object() ?>
                        <?php echo $__env->make('assignments.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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