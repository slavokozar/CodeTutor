<?php $__env->startSection('sidebar'); ?>
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($tag->tag); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">Články</li>
    </ol>

    <h1>Články</h1>

    <?php if(Auth::check() && Auth::user()->isArticleAuthor()): ?>
        <div class="row">
            <div class="col-md-60">
                <ul id="content-nav-tabs" class="nav nav-tabs">
                    <li role="presentation">
                        <a href="<?php echo e(action('Articles\ArticleController@create')); ?>" class="btn">Vytvoriť nový</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php if(count($articles) == 0): ?>
        <p class="text-center text-danger">
            Práve tu nie su žiadne články.<br/>
            <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i><br/>
            Ľutujeme, ak si myslíte, že články by tu mali byť, neváhajte <a href="/#contact">kontaktovať</a> správcov.
        </p>
    <?php else: ?>
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articleObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="article <?php echo e($articleObj->is_public ? '' : 'private'); ?>">
                <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">
                    <h2 class="article-name"><?php echo e($articleObj->name); ?></h2>
                </a>
                
                <p><?php echo $articleObj->description; ?></p>
                <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">Viac...</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>