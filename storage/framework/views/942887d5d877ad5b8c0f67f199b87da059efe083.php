<div class="col-sm-10">
    <div class="images-square" data-image="<?php echo e($imageObj->code); ?>">
        <img class="images-inner" alt="image"
             src="<?php echo e($imageObj->url()); ?>">
        <div class="images-info">
            <span class="images-caption"><?php echo e($imageObj->name); ?>.<?php echo e($imageObj->ext); ?></span>
        </div>
    </div>
</div>