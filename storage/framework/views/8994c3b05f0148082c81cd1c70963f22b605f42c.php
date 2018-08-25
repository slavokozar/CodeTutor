<div class="comment-response">
    <div class="avatar">
        <img class="img-responsive" src="<?php echo Auth::user()->avatar(); ?>"/>
    </div>

    <div class="comment">
        <form action="<?php echo e(action('System\CommentController@store',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])); ?>" method="post">
            <?php echo csrf_field(); ?>

            <textarea class="form-control" rows="3" name="comment" placeholder="Pridajte odpoveď..."></textarea>
            <button type="submit" class="btn btn-sm btn-danger pull-right">Odoslať</button>
            <button class="btn btn-cancel btn-sm btn-default pull-right">Zrušiť</button>
        </form>
    </div>
</div>