<?php $__env->startSection('content-main'); ?>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Články</a></li>
        <li class="active"><?php echo e($articleObj->name); ?></li>
    </ol>

    <h1><?php echo $articleObj->is_public ? '' : 'profile'; ?><?php echo e($articleObj->name); ?></h1>

    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <a href="<?php echo e(action('Articles\ArticleController@edit',[$articleObj->code])); ?>">Upraviť</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo e(action('Articles\ArticleController@delete',[$articleObj->code])); ?>">Vymazať</a>
                </li>
            </ul>
        </div>
    </div>


    <section id="assignments">
        <?php echo $content; ?>

    </section>


    
        
        {{--<?php $objectObj = $articleObj; ?>--}}

        

        
            
                
            
        
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/comments.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>