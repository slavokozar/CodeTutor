<section class="sidebar dark" style="padding:0 20px">
    <div class="sidebar-wrapper">
        <h2>Zadania</h2>
        <?php if(sizeof($groups) > 0): ?>
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h3><?php echo e($group->name); ?></h3>
            <ul>
                <?php $__currentLoopData = $group->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(action('Assignments\AssignmentController@show',[$assignment->code])); ?>"><?php echo e($assignment->name); ?></a>

                    <?php if(Auth::check() && $group->isLecturer(Auth::user())): ?>
                    <span class="toolbar pull-right">
                        <a href="<?php echo e(action('Assignments\AssignmentController@edit',[$assignment->code])); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                    </span>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>Žiadne dostupné zadania</p>
        <?php endif; ?>

    </div>
</section>