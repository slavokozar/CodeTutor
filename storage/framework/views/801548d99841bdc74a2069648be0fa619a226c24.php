<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.files.link') ]
        ]); ?>


    <h1><?php echo e(trans('profile.files.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Files\FileController@create']
            ]
        ]); ?>


    <section class="table-list">
        <?php if(count($files) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('profile.files.no-files'); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="<?php echo e(action('Files\FileController@show',[$fileObj->code])); ?>">
                                <?php echo e($fileObj->name); ?>

                            </a>
                        </div>
                        <div class="table-column-date"><?php echo e($fileObj->updated_at); ?></div>
                    </div>
                    <div class="table-row-description">
                        <?php echo e($fileObj->description); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>