<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('files.link'), 'action' => 'Files\FileController@index' ],
        ];

        if($fileObj->id){
            $breadcrumb[] = [ 'action' => 'Files\FileController@show', 'params' => [$fileObj->code], 'label' => $fileObj->name];
            $breadcrumb[] = [ 'label' => trans('general.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('general.create') ];
        }
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($fileObj->id): ?>
        <h1><?php echo e($fileObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('files.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($fileObj->id == null){
            $_form_action = 'Files\FileController@store';
            $_form_params = [$fileObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Files\FileController@update';
            $_form_params = [$fileObj->code];
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

            <?php if($fileObj->id != null): ?>
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        <?php echo e($fileObj->code); ?>

                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="assignmentName"><?php echo e(trans('files.labels.name')); ?></label>
                <div class="col-md-40">
                    <input id="assignmentName" type="text" class="form-control" name="name"
                           value="<?php echo e(old('name', $fileObj->name)); ?>">
                    <?php if( $errors->has('name') ): ?>
                        <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php $sharedObject = $fileObj ?>
            <div class="form-group<?php echo e($errors->has('share') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="assignmentShare"><?php echo e(trans('files.labels.share')); ?></label>
                <div class="col-md-40">
                    <select name="share[]" id="assignmentShare" class="js-select" multiple>
                        <?php $__currentLoopData = $groups['public_groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($groupObj->id); ?>"
                                    <?php echo e($fileObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

                            >
                                <?php echo e($groupObj->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $groups['schools']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $schoolObj = $school['school'] ?>
                            <optgroup label="<?php echo e($schoolObj->name); ?>">
                                <option value="school_<?php echo e($schoolObj->id); ?>"
                                        <?php echo e($fileObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : ''); ?>

                                >
                                    <?php echo e(trans('users.schools.share')); ?>

                                    <?php echo e($schoolObj->name); ?>

                                </option>
                                <?php $__currentLoopData = $school['groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($groupObj->id); ?>"
                                            <?php echo e($fileObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : ''); ?>

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
                <label class="col-md-20" for="assignmentDescription"><?php echo e(trans('files.labels.description')); ?></label>
                <div class="col-md-40">
                    <textarea id="assignmentDescription" class="form-control" name="description" rows="3"
                              placeholder="<?php echo e(trans('files.labels.description')); ?>" <?php echo e($fileObj->id ? '' : 'disabled'); ?>><?php echo e(old('description', $fileObj->description)); ?></textarea>

                    <?php if( $errors->has('description') ): ?>
                        <span class="help-block"><?php echo e($errors->first('description')); ?></span>
                    <?php endif; ?>
                </div>
            </div>



        </section>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>