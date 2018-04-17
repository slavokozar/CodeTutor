<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
            [ 'label' => $articleObj->name]
        ]); ?>



    <h1><?php echo e($articleObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Articles\ArticleController@edit', 'params' => [$articleObj->code]],
                ['label' => trans('general.buttons.delete'), 'action' => 'Articles\ArticleController@deleteModal', 'params' => [$articleObj->code], 'modal' => true]
            ]
        ]); ?>


    <section id="article">
        <?php echo $articleObj->text; ?>

    </section>

    <section id="attachements">
        <?php if($articleObj->images()->count() == 0): ?>
            <p><?php echo e(trans('articles.labels.no-images')); ?></p>
        <?php else: ?>
            <ul>
                <?php $__currentLoopData = $articleObj->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($imageObj->name); ?>.<?php echo e($imageObj->ext); ?></li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </section>


    
    
    {{--<?php $objectObj = $articleObj; ?>--}}

    

    
    
    
    
    
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/comments.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>