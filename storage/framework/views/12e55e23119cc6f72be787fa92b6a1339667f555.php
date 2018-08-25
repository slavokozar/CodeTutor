<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.link') ]
        ]); ?>



    <h1><?php echo e(trans('articles.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ]); ?>


    <section id="activities-list">

        <?php if(count($articles) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('articles.no-articles'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articleObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="activity <?php echo e($articleObj->is_public ? '' : 'private'); ?>">

                    <div class="activity-image">
                        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                    </div>
                    <div class="activity-content">
                        <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">
                            <h2><?php echo e($articleObj->name); ?></h2>
                        </a>
                        <div class="activity-details">
                            <span class="activity-author"><?php echo e(trans('feed.from-user')); ?> <?php echo e($articleObj->author->name); ?></span>

                            <?php if($articleObj->group != null): ?><span class="activity-group"><?php echo e(trans('feed.in-group')); ?> <?php echo e($articleObj->group->name); ?></span><?php endif; ?>
                            <span class="activity-date"><?php echo e($articleObj->updated_at); ?></span>
                        </div>
                        <p class="activity-description">
                            <?php echo $articleObj->description; ?>

                            <a class="read-more" href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>"><?php echo e(trans('articles.read-more')); ?></a>
                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo $articles->render(); ?>

        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>