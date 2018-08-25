<?php $__env->startSection('content-main'); ?>
    <?php if($objectObj instanceof App\Models\Articles\Article): ?>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            <li><a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Články</a></li>
            <li><a href="<?php echo e(action('Articles\ArticleController@show',[$objectObj->code])); ?>"><?php echo e($objectObj->name); ?></a></li>
            <li class="active">Komentáre</li>
        </ol>
    <?php elseif($objectObj instanceof App\Models\Assignments\Assignment): ?>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            <li><a href="<?php echo e(action('Assignments\AssignmentController@index')); ?>">Zadania</a></li>
            <li><a href="<?php echo e(action('Assignments\AssignmentController@show',[$objectObj->code])); ?>"><?php echo e($objectObj->name); ?></a></li>
            <li class="active">Komentáre</li>
        </ol>
    <?php endif; ?>
    <section id="comments">
        <?php echo $__env->make('comments.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>