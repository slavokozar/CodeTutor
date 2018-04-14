<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo e(trans('articles.delete.heading')); ?></h4>
                </div>
                <div class="modal-body">
                    <div id="images-upload">
                        <form method="post" action="<?php echo e(action('Articles\ImageController@store', [$articleObj == null ? 'null' : $articleObj->code])); ?>" enctype="multipart/form-data">
                            <div class="upload-area">
                                <a href="#">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    <p><?php echo e(trans('builder/media.modal.images.drag')); ?></p>
                                </a>

                                <input type="file" name="files" multiple>
                            </div>
                        </form>
                    </div>



                    <div id="images-row" class="row">
                            <?php if(count($images) == 0): ?>
                                <div id="images-empty" class="col-md-60 text-center">
                                    <p><?php echo e(trans('images.empty')); ?></p>
                                    <p><?php echo e(trans('images.empty-hint')); ?></p>
                                </div>
                            <?php else: ?>


                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('files.images.modal-thumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="col-md-60 paginator">
                                    
                                </div>
                            <?php endif; ?>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo e(trans('general.buttons.cancel')); ?></button>
                    <button type="button" class="btn btn-danger success"><?php echo e(trans('general.buttons.insert')); ?></button>
                </div>

        </div>
    </div>
</div>