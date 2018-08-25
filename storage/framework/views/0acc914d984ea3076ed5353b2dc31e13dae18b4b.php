<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.link'), 'action' => 'Articles\ArticleController@index' ],
        ];

        if($articleObj->id){
            $breadcrumb[] = [ 'action' => 'Articles\ArticleController@show', 'params' => [$articleObj->code], 'label' => $articleObj->name];
            $breadcrumb[] = [ 'label' => trans('articles.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('articles.create') ];
        }
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($articleObj->id): ?>
        <h1><?php echo e($articleObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('articles.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($articleObj->id == null){
            $_form_action = 'Articles\ArticleController@store';
            $_form_params = [$articleObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Articles\ArticleController@update';
            $_form_params = [$articleObj->code];
            $_form_method = 'put';
        }
    ?>

    <form class="form-horizontal" action="<?php echo e(action($_form_action, $_form_params)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <?php if($_form_method != 'post'): ?>
            <input type="hidden" name="_method" value="<?php echo e($_form_method); ?>">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => trans('general.save')]); ?>


        <section id="basic">

            <?php if($articleObj->id != null): ?>
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        <?php echo e($articleObj->code); ?>

                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleName"><?php echo e(trans('articles.labels.name')); ?></label>
                <div class="col-md-40">
                    <input id="articleName" type="text" class="form-control" name="name"
                           value="<?php echo e(old('name', $articleObj->name)); ?>">
                    <?php if( $errors->has('name') ): ?>
                        <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group<?php echo e($errors->has('is_public') ? ' has-error' : ''); ?>">
                <div class="col-md-40 col-md-offset-20">
                    <div class="checkbox">
                        <label>
                            <input name="is_public" type="checkbox"
                                   <?php if((old('is_public') !== null && old('is_public'))): ?> checked <?php endif; ?>> Verejný článok
                        </label>
                    </div>
                </div>
            </div>

            <?php $sharedObject = $articleObj ?>
            <div class="form-group<?php echo e($errors->has('share') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleShare"><?php echo e(trans('articles.labels.share')); ?></label>
                <div class="col-md-40">
                    <select name="share[]" id="articleShare" class="js-select" multiple>
                        <?php $__currentLoopData = $groups['public_groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($groupObj->id); ?>"
                                <?php echo e($articleObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

                            >
                                <?php echo e($groupObj->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $groups['schools']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $schoolObj = $school['school'] ?>
                            <optgroup label="<?php echo e($schoolObj->name); ?>">
                                <option value="school_<?php echo e($schoolObj->id); ?>"
                                    <?php echo e($articleObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : ''); ?>

                                >
                                    <?php echo e(trans('users.schools.share')); ?>

                                    <?php echo e($schoolObj->name); ?>

                                </option>
                                <?php $__currentLoopData = $school['groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($groupObj->id); ?>"
                                        <?php echo e($articleObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

                                    >
                                        <?php echo e(trans('users.labels.group')); ?>

                                        <?php echo e($groupObj->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php if( $errors->has('share') ): ?>
                        <span class="help-block"><?php echo e($errors->first('share')); ?></span>
                    <?php endif; ?>
                </div>
            </div>


            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleDescription"><?php echo e(trans('articles.labels.description')); ?></label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>

                            <input id="articleNoDescription" name="no-description"
                                   type="checkbox" <?php echo e(old('no-description', $articleObj->id == null) ? 'checked' : ''); ?>><?php echo e(trans('articles.labels.description-same-as-article')); ?>

                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="<?php echo e(trans('articles.labels.description')); ?>" <?php echo e($articleObj->id ? '' : 'disabled'); ?>><?php echo e(old('description', $articleObj->description)); ?></textarea>

                    <?php if( $errors->has('description') ): ?>
                        <span class="help-block"><?php echo e($errors->first('description')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($articleObj->id != null): ?>
                <div class="form-group">
                    <label class="col-md-20" for="articleImages"><?php echo e(trans('articles.labels.images')); ?></label>
                    <div id="articleImages" class="col-md-40">
                        <div id="articleImages-empty"
                             class="<?php echo e((count($articleObj->images) > 0) ? 'hidden' : ''); ?>">
                            <?php echo e(trans('articles.labels.no-images')); ?>

                        </div>
                        <ul>
                            <?php $__currentLoopData = $articleObj->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('files.images.article-thumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-20" for="articleAttachments"><?php echo e(trans('articles.labels.attachments')); ?></label>
                    <div id="articleAttachments" class="col-md-40">
                        <div id="articleAttachments-empty"
                             class="<?php echo e((count($articleObj->attachments) > 0) ? 'hidden' : ''); ?>">
                            <?php echo e(trans('articles.labels.no-attachments')); ?>

                        </div>
                        <ul>
                            <?php $__currentLoopData = $articleObj->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachmentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('files.attachment.article-thumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                
                    
                    
                        
                             
                            
                        
                        
                            
                                
                                
                            
                        
                    
                

                
                    
                    
                        
                             
                            
                        
                        
                            
                                
                                
                            
                        
                    
                
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                <label class="col-md-60" for="articleContent"><?php echo e(trans('articles.labels.content')); ?></label>
                <div class="col-md-60">


                    <textarea id="articleContent" class="md-editor form-control" name="text" rows="10"
                              placeholder="<?php echo e(trans('articles.labels.text')); ?>"><?php echo e(old('text', $articleObj->text)); ?></textarea>
                    <?php if( $errors->has('text') ): ?>
                        <span class="help-block"><?php echo e($errors->first('text')); ?></span>
                    <?php endif; ?>
                </div>
            </div>



        </section>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var $content = $("#articleContent");
        var $noDescCheck = $('#articleNoDescription');
        var $descText = $('#articleDescription');
        var descLength = 10;

        var imagesModalUrl = '<?php echo e(action('Articles\ImageController@index', [$articleObj->id == null ? 'null' : $articleObj->code])); ?>'
        var imageModalThumb = '<?php echo e(action('Files\ImageController@modalThumb', '?')); ?>';
        var imageArticleThumb = '<?php echo e(action('Files\ImageController@articleThumb', '?')); ?>';
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>