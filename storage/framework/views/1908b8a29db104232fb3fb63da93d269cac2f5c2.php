<div class="comment-wrapper" data-comment="<?php echo e($commentObj->id); ?>">
    <div class="avatar">
        <img class="img-responsive" src="<?php echo e($commentObj->author->avatar()); ?>"/>
    </div>
    <div class="comment">
        <span class="comment-name"><?php echo e($commentObj->author->name); ?></span>
        <span class="comment-time">- <?php echo e($commentObj->created_at); ?></span>
        <?php if($commentObj->created_at != $commentObj->updated_at): ?>
            <span class="comment-time">- upravené <?php echo e($commentObj->updated_at); ?></span>
        <?php endif; ?>

        <?php if(Auth::check() && $commentObj->canModify(Auth::user())): ?>
            <div class="comment-tool">
                <a class="comment-remove" href="<?php echo e(action('System\CommentController@destroy',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])); ?>">
                    <i class="fa fa-trash" aria-hidden="true"></i> Odstrániť

                </a>
                <a class="comment-edit" href="<?php echo e(action('System\CommentController@edit',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])); ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Upraviť
                </a>
            </div>

        <?php endif; ?>

        <p><?php echo e($commentObj->text); ?></p>

        <?php if(Auth::check() && $commentObj->canReply(Auth::user())): ?>
            <a href="<?php echo e(action('System\CommentController@create',[$objectObj->commentRoute, $objectObj->code, $commentObj->reply_to_id == null ? $commentObj->id : $commentObj->reply_to_id])); ?>" class="comment-reply">
                <i class="fa fa-reply" aria-hidden="true"></i> Odpovedať
            </a>
        <?php endif; ?>
    </div>



    <?php if($commentObj->reply_to_id == null): ?>
        <div class="comment-clear"></div>
        <div class="comment-replies">
            <?php $__currentLoopData = $commentObj->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('comments.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>


</div>
