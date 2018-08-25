<?php if(Auth::check()): ?>
    <div class="comment-wrapper">
        <form id="comment-add" method="post" action="<?php echo e(action('System\CommentController@store',[$objectObj->commentRoute, $objectObj->code])); ?>">
            <?php echo csrf_field(); ?>

            <div class="avatar">
                <img class="img-responsive" src="<?php echo e(Auth::user()->avatar()); ?>"/>
                
            </div>

            <div class="comment">
                <textarea name="comment" class="form-control" rows="1" placeholder="Pridajte komentár..."></textarea>
            </div>

            <button type="submit" class="btn btn-sm btn-danger hidden">Odoslať</button>
        </form>
    </div>
<?php else: ?>
    <p class="text-center text-danger">Musíte sa prihlásiť, aby ste mohli vytvárať, alebo odpovedať na komentáre.</p>
<?php endif; ?>


<?php if(!isset($comments)) $comments = $objectObj->comments; ?>
<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('comments.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

