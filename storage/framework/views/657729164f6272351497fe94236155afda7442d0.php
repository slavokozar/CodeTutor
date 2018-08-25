<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.links.link') ]
        ]); ?>


    <h1><?php echo e(trans('profile.links.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Links\LinkController@create']
            ]
        ]); ?>


    <section class="table-list">
        <?php if(count($links) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('profile.links.no-links'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $linkObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="<?php echo e(action('Links\LinkController@show',[$linkObj->code])); ?>">
                                <?php echo e($linkObj->name); ?>

                            </a>
                        </div>
                        <div class="table-column-date"><?php echo e($linkObj->updated_at); ?></div>
                    </div>
                    <div class="table-row-description">
                        <?php echo e($linkObj->description); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>