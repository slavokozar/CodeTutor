<div class="row">
    <div class="col-md-20">
        <label for="">#</label>
    </div>
    <div class="col-md-40">
        <?php echo e($userObj->code); ?>

    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for=""><?php echo e(trans('users.labels.name')); ?></label>
    </div>
    <div class="col-md-40">
        <?php echo e($userObj->name); ?>

    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for=""><?php echo e(trans('users.labels.email')); ?></label>
    </div>
    <div class="col-md-40">
        <?php echo e($userObj->email); ?>

    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for=""><?php echo e(trans('users.labels.birthdate')); ?></label>
    </div>
    <div class="col-md-40">
        <?php echo e($userObj->name); ?>

    </div>
</div>