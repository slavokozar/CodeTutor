<section id="basic">
    <?php echo DataRender::render([
            ['label'=>'#', 'value'=>$userObj->code],
            ['label'=>trans('users.labels.title'), 'value'=>$userObj->title],
            ['label'=>trans('users.labels.name'), 'value'=>$userObj->name],
            ['label'=>trans('users.labels.surname'), 'value'=>$userObj->surname],
            ['label'=>trans('users.labels.email'), 'value'=>$userObj->email],
            ['label'=>trans('users.labels.birthdate'), 'value'=>$userObj->birthdate]
        ]); ?>

</section>

<?php if(isset($schools)): ?>
<section id="schools">
    <h3><?php echo e(trans('users.schools.heading')); ?></h3>

    <?php $schools = $userObj->schools ?>
    <?php if($schools->count() > 0): ?>
        <ul class="list-group">
            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item"><?php echo e($schoolObj->name); ?>

                    (<?php echo e(trans('users.schools.roles')[$schoolObj->pivot->role]); ?>)
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-schools')); ?></div>
    <?php endif; ?>
</section>
<?php endif; ?>

<?php if(isset($groups)): ?>
<section id="groups">
    <h3><?php echo e(trans('users.groups.heading')); ?></h3>

    <?php $groups = $userObj->groups ?>
    <?php if($groups->count() > 0): ?>
        <ul class="list-group">
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item"><?php echo e($groupObj->name); ?>

                    (<?php echo e(trans('users.groups.roles')[$groupObj->pivot->role]); ?>)
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info" role="alert"><?php echo e(trans('users.users.no-groups')); ?></div>
    <?php endif; ?>
</section>
<?php endif; ?>