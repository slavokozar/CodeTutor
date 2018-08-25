<form class="form-horizontal" action="<?php echo e(action($_form_action, $_form_params)); ?>" method="post">
    <?php echo csrf_field(); ?>

    <?php if($_form_method != 'post'): ?>
        <input type="hidden" name="_method" value="<?php echo e($_form_method); ?>">
    <?php endif; ?>

    <?php echo ContentNav::submit(['label' => trans('general.save')]); ?>


    <section id="basic">

        <?php if($userObj->id != null): ?>
            <div class="row">
                <div class="col-md-20">
                    <label for="">#</label>
                </div>
                <div class="col-md-40">
                    <?php echo e($userObj->code); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
            <label class="col-md-20" for=""><?php echo e(trans('users.labels.title')); ?></label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="title"
                       value="<?php echo e(old('title', $userObj->title)); ?>"/>
                <?php if( $errors->has('title') ): ?>
                    <span class="help-block"><?php echo e($errors->first('title')); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
            <label class="col-md-20" for=""><?php echo e(trans('users.labels.name')); ?></label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="name" value="<?php echo e(old('name', $userObj->name)); ?>"/>
                <?php if( $errors->has('name') ): ?>
                    <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group<?php echo e($errors->has('surname') ? ' has-error' : ''); ?>">
            <label class="col-md-20" for=""><?php echo e(trans('users.labels.surname')); ?></label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="surname"
                       value="<?php echo e(old('surname', $userObj->surname)); ?>"/>
                <?php if( $errors->has('surname') ): ?>
                    <span class="help-block"><?php echo e($errors->first('surname')); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <label class="col-md-20" for=""><?php echo e(trans('users.labels.email')); ?></label>
            <div class="col-md-40">
                <input class="form-control" type="email" name="email"
                       value="<?php echo e(old('email', $userObj->email)); ?>"/>
                <?php if( $errors->has('email') ): ?>
                    <span class="help-block"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group<?php echo e($errors->has('birthdate') ? ' has-error' : ''); ?>">
            <label class="col-md-20" for=""><?php echo e(trans('users.labels.birthdate')); ?></label>
            <div class="col-md-40">
                <input class="form-control" type="date" name="birthdate"
                       value="<?php echo e(old('birthdate', $userObj->birthdate)); ?>"/>
                <?php if( $errors->has('birthdate') ): ?>
                    <span class="help-block"><?php echo e($errors->first('birthdate')); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </section>
</form>