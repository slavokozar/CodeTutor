<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
        ];

        if($assignmentObj->id){
            $breadcrumb[] = [ 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code], 'label' => $assignmentObj->name];
            $breadcrumb[] = [ 'label' => trans('assignments.assignments.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('assignments.assignments.create') ];
        }
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($assignmentObj->id): ?>
        <h1><?php echo e($assignmentObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('assignments.assignments.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($assignmentObj->id == null){
            $_form_action = 'Assignments\AssignmentController@store';
            $_form_params = [$assignmentObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Assignments\AssignmentController@update';
            $_form_params = [$assignmentObj->code];
            $_form_method = 'put';
        }
    ?>

    <?php if($errors->any()): ?>

        <?php
        print_r($errors)
        ?>
        <div class="alert alert-danger">
            <ul>

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>


    <form class="form-horizontal" action="<?php echo e(action($_form_action, $_form_params)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <?php if($_form_method != 'post'): ?>
            <input type="hidden" name="_method" value="<?php echo e($_form_method); ?>">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => trans('general.buttons.save')]); ?>


        <section id="basic">

            <?php if($assignmentObj->id != null): ?>
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        <?php echo e($assignmentObj->code); ?>

                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleName"><?php echo e(trans('articles.labels.name')); ?></label>
                <div class="col-md-40">
                    <input id="articleName" type="text" class="form-control" name="name"
                           value="<?php echo e(old('name', $assignmentObj->name)); ?>">
                    <?php if( $errors->has('name') ): ?>
                        <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php $sharedObject = $assignmentObj ?>
            <div class="form-group<?php echo e($errors->has('share') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleShare"><?php echo e(trans('articles.labels.share')); ?></label>
                <div class="col-md-40">
                    <select name="share[]" id="articleShare" class="js-select" multiple>
                        <?php $__currentLoopData = $groups['public_groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($groupObj->id); ?>"
                                    <?php echo e($assignmentObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

                            >
                                <?php echo e($groupObj->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $groups['schools']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $schoolObj = $school['school'] ?>
                            <optgroup label="<?php echo e($schoolObj->name); ?>">
                                <option value="school_<?php echo e($schoolObj->id); ?>"
                                        <?php echo e($assignmentObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : ''); ?>

                                >
                                    <?php echo e(trans('users.schools.share')); ?>

                                    <?php echo e($schoolObj->name); ?>

                                </option>
                                <?php $__currentLoopData = $school['groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($groupObj->id); ?>"
                                            <?php echo e($assignmentObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

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



            <div class="row">
                <label for="" class="col-lg-20">Odovzdávanie</label>
                <div class="col-md-20">
                    <div class="form-group<?php echo e($errors->has('start') ? ' has-error' : ''); ?>">
                        <label class="col-lg-10" for="assignmentStart">od:</label>
                        <div class="col-lg-50">
                            <input class="form-control" id="assignmentStart" type="date" name="start"
                                   value="<?php echo e(old('start', $assignmentObj->start_at)); ?>">
                        </div>
                        <?php if($errors->has('start')): ?>
                            <div class="col-lg-60">
                                <?php $__currentLoopData = $errors->get('start'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="help-block"><?php echo e($error); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-20">
                    <div class="form-group<?php echo e($errors->has('deadline') ? ' has-error' : ''); ?>">
                        <label class="col-lg-10" for="assignmentDeadline">do</label>
                        <div class="col-lg-50">
                            <input class="form-control" id="assignmentDeadline" type="date"
                                   name="deadline"
                                   value="<?php echo e(old('deadline', $assignmentObj->deadline_at)); ?>">
                        </div>

                        <?php if($errors->has('deadline')): ?>
                            <div class="col-lg-60">
                                <?php $__currentLoopData = $errors->get('deadline'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="help-block"><?php echo e($error); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleDescription">Povolené jazyky</label>
                <div class="col-md-40">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox">
                            <label>
                                <input name="languages[]" type="checkbox" value="<?php echo e($languageObj->id); ?>">
                                <?php echo e($languageObj->name); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>


            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleDescription"><?php echo e(trans('articles.labels.description')); ?></label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>

                            <input id="articleNoDescription" name="no-description"
                                   type="checkbox" <?php echo e(old('no-description', $assignmentObj->id == null) ? 'checked' : ''); ?>><?php echo e(trans('articles.labels.description-same-as-article')); ?>

                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="<?php echo e(trans('articles.labels.description')); ?>" <?php echo e($assignmentObj->id ? '' : 'disabled'); ?>><?php echo e(old('description', $assignmentObj->description)); ?></textarea>

                    <?php if( $errors->has('description') ): ?>
                        <span class="help-block"><?php echo e($errors->first('description')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($assignmentObj->id != null): ?>
                <div class="form-group">
                    <label class="col-md-20" for="articleImages"><?php echo e(trans('articles.labels.images')); ?></label>
                    <div id="articleImages" class="col-md-40">
                        <div id="articleImages-empty"
                             class="<?php echo e((count($assignmentObj->images) > 0) ? 'hidden' : ''); ?>">
                            <?php echo e(trans('articles.labels.no-images')); ?>

                        </div>
                        <ul>
                            <?php $__currentLoopData = $assignmentObj->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('files.images.article-thumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-20"
                           for="articleAttachments"><?php echo e(trans('articles.labels.attachments')); ?></label>
                    <div id="articleAttachments" class="col-md-40">
                        <div id="articleAttachments-empty"
                             class="<?php echo e((count($assignmentObj->attachments) > 0) ? 'hidden' : ''); ?>">
                            <?php echo e(trans('articles.labels.no-attachments')); ?>

                        </div>
                        <ul>
                            <?php $__currentLoopData = $assignmentObj->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachmentObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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


                    <textarea id="articleContent" class="form-control" name="text" rows="10"
                              placeholder="<?php echo e(trans('articles.labels.text')); ?>"><?php echo e(old('text', $assignmentObj->text)); ?></textarea>
                    <?php if( $errors->has('text') ): ?>
                        <span class="help-block"><?php echo e($errors->first('text')); ?></span>
                    <?php endif; ?>
                </div>
            </div>


        </section>
    </form>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    

    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    




    
    
    
    
    

    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/simplemde.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.iframe-transport.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.fileupload.js')); ?>"></script>

    <script>
        var $content = $("#articleContent");
        var $noDescCheck = $('#articleNoDescription');
        var $descText = $('#articleDescription');
        var descLength = 10;

        var imagesModalUrl = '<?php echo e(action('Articles\ImageController@index', [$assignmentObj->id == null ? 'null' : $assignmentObj->code])); ?>'
        var imageModalThumb = '<?php echo e(action('Files\ImageController@modalThumb', '?')); ?>';
        var imageArticleThumb = '<?php echo e(action('Files\ImageController@articleThumb', '?')); ?>';
    </script>
    <script src="<?php echo e(asset('js/modules/md-editor.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>