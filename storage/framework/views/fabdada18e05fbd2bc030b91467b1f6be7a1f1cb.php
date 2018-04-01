<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'label' => $groupObj->name ]
        ]); ?>


    <?php if($groupObj->id): ?>
        <h1><?php echo e($groupObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('users.groups.create')); ?></h1>
    <?php endif; ?>

    <form class="form-horizontal"
          action="<?php echo e($groupObj->id == null ? action('Users\Groups\GroupController@store') : action('Users\Schools\GroupController@update', $groupObj->code)); ?>"
          method="post">
        <?php echo csrf_field(); ?>

        <?php if($groupObj->id != null): ?>
            <input type="hidden" name="_method" value="put">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => trans('general.buttons.save')]); ?>


        <main role="main">
            <section id="basic">

                <?php if($groupObj->id != null): ?>
                    <div class="row">
                        <div class="col-md-20">
                            <label for="">#</label>
                        </div>
                        <div class="col-md-40">
                            <?php echo e($groupObj->code); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label class="col-md-20" for=""><?php echo e(trans('users.labels.name')); ?></label>
                    <div class="col-md-40">
                        <input class="form-control" type="text" name="name"
                               value="<?php echo e(old('name', $groupObj->name)); ?>"/>
                        <?php if( $errors->has('name') ): ?>
                            <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                    <div class="form-group<?php echo e($errors->has('school_id') ? ' has-error' : ''); ?>">
                        <label class="col-md-20" for=""><?php echo e(trans('users.labels.school')); ?></label>
                        <div class="col-md-40">

                            <select class="form-control" name="school_id">
                                <option value="">Global</option>
                                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($schoolObj->id); ?>"<?php echo e(old('school_id', $groupObj->school_id) == $schoolObj->id ? ' selected' : ''); ?>><?php echo e($schoolObj->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                                   
                            <?php if( $errors->has('school_id') ): ?>
                                <span class="help-block"><?php echo e($errors->first('school_id')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


            </section>
        </main>


    </form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>