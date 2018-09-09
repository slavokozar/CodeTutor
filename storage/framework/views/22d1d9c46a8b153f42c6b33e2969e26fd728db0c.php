<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $schoolObj->name ]
        ]); ?>


    <?php if($schoolObj->id): ?>
        <h1><?php echo e($schoolObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('users.schools.create')); ?></h1>
    <?php endif; ?>

    <form class="form-horizontal"
          action="<?php echo e($schoolObj->id == null ? action('Users\Schools\SchoolController@store') : action('Users\Schools\SchoolController@update', $schoolObj->code)); ?>"
          method="post">
        <?php echo csrf_field(); ?>

        <?php if($schoolObj->id != null): ?>
            <input type="hidden" name="_method" value="put">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => $schoolObj->id ? trans('general.save') : trans('general.create')]); ?>


        <section id="basic">

            <?php if($schoolObj->id != null): ?>
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        <?php echo e($schoolObj->code); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.name')); ?></label>
                <div class="col-md-40">
                    <input class="form-control" type="text" name="name"
                           value="<?php echo e(old('name', $schoolObj->name)); ?>"/>
                    <?php if( $errors->has('name') ): ?>
                        <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.address')); ?></label>
                <div class="col-md-40">
                        <textarea class="form-control"
                                  name="address"><?php echo e(old('address', $schoolObj->address)); ?></textarea>
                    <?php if( $errors->has('address') ): ?>
                        <span class="help-block"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group<?php echo e($errors->has('url') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.url')); ?></label>
                <div class="col-md-40">
                    <input class="form-control" type="text" name="url" value="<?php echo e(old('url', $schoolObj->url)); ?>"/>
                    <?php if( $errors->has('url') ): ?>
                        <span class="help-block"><?php echo e($errors->first('url')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>