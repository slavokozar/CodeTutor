<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.articles.link') ]
        ]); ?>


    <h1><?php echo e(trans('profile.articles.link')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ]); ?>


    <section class="table-list">
        <?php if(count($articles) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('profile.articles.no-articles'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articleObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">
                                <?php echo e($articleObj->name); ?>

                            </a>
                        </div>
                        <div class="table-column-date"><?php echo e($articleObj->updated_at); ?></div>
                    </div>
                    <div class="table-row-description">
                        <?php echo e($articleObj->description); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>