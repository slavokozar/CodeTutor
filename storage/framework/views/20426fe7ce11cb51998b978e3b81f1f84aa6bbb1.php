<li>
    <div class="row">
        <div class="col-md-8">
            <img class="img-responsive" src="<?php echo e($imageObj->url()); ?>"/>
        </div>
        <div class="col-md-44">
            <?php echo e($imageObj->name); ?>

        </div>
        <div class="col-md-8">
            <a class="image-delete"
               href="<?php echo e(action('Files\ImageController@delete', [$imageObj->id])); ?>">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
        </div>
    </div>

</li>