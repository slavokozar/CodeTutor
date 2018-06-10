<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.link') ]
        ]); ?>



    <h1><?php echo e(trans('articles.heading')); ?></h1>

    <?php if(Auth::check() && Auth::user()->isAuthor()): ?>
    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ]); ?>

    <?php endif; ?>

    <section id="activities-list">

        <?php if(count($articles) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('articles.no-articles'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articleObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('articles.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo $articles->render(); ?>

        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>