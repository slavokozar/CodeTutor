<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li class="active"><?php echo e($userObj->name); ?></li>
    </ol>

    <h1><?php echo e($userObj->name); ?></h1>

    <form class="form-horizontal" action="<?php echo e($userObj->id == null ? action('Users\UserController@store') : action('Users\UserController@update', $userObj->code)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <?php if($userObj->id != null): ?>
        <input type="hidden" name="_method" value="put">
        <?php endif; ?>

        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
            <li class="active" role="presentation">
                <button class="btn" type="submit"><?php echo e(trans('general.buttons.save')); ?></button>
            </li>
        </ul>

        <main role="main">
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
                    <input class="form-control" type="text" name="title" value="<?php echo e(old('title', $userObj->title)); ?>"/>
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
                    <input class="form-control" type="text" name="surname" value="<?php echo e(old('surname', $userObj->surname)); ?>"/>
                    <?php if( $errors->has('surname') ): ?>
                        <span class="help-block"><?php echo e($errors->first('surname')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.email')); ?></label>
                <div class="col-md-40">
                    <input class="form-control" type="email" name="email" value="<?php echo e(old('email', $userObj->email)); ?>"/>
                    <?php if( $errors->has('email') ): ?>
                        <span class="help-block"><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group<?php echo e($errors->has('birthdate') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.birthdate')); ?></label>
                <div class="col-md-40">
                    <input class="form-control" type="date" name="birthdate" value="<?php echo e(old('birthdate', $userObj->birthdate)); ?>"/>
                    <?php if( $errors->has('birthdate') ): ?>
                        <span class="help-block"><?php echo e($errors->first('birthdate')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group<?php echo e($errors->has('schools') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for=""><?php echo e(trans('users.labels.schools')); ?></label>
                <div class="col-md-40">

                    <?php if( $errors->has('schools') ): ?>
                        <span class="help-block"><?php echo e($errors->first('schools')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </main>


    </form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>