<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <?php if(!isset($_table_skip['name'])): ?>
            <th><?php echo e(trans('users.labels.name')); ?></th>
        <?php endif; ?>
        <?php if(!isset($_table_skip['email'])): ?>
            <th><?php echo e(trans('users.labels.email')); ?></th>
        <?php endif; ?>
        <?php if(!isset($_table_skip['roles'])): ?>
            <th><?php echo e(trans('users.labels.roles')); ?></th>
        <?php endif; ?>
        <?php if(!isset($_table_skip['school'])): ?>
            <th><?php echo e(trans('users.labels.school')); ?></th>
        <?php endif; ?>
        <?php if(!isset($_table_skip['groups'])): ?>
            <th><?php echo e(trans('users.labels.groups')); ?></th>
        <?php endif; ?>
        <?php if(isset($_table_actions)): ?>
            <th>&nbsp;</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th scope="row">
                <?php if(isset($_table_action)): ?>
                    <a href="<?php echo e($_table_action($userObj)); ?>"><?php echo e($userObj->code); ?></a>
                <?php else: ?>
                    <?php echo e($userObj->code); ?>

                <?php endif; ?>
            </th>
            <td>
                <?php if(!isset($_table_skip['name'])): ?>
                    <?php if(isset($_table_action)): ?>
                        <a href="<?php echo e($_table_action($userObj)); ?>"><?php echo e($userObj->title); ?> <?php echo e($userObj->name); ?> <?php echo e($userObj->surname); ?></a>
                    <?php else: ?>
                        <?php echo e($userObj->title); ?> <?php echo e($userObj->name); ?> <?php echo e($userObj->surname); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <?php if(!isset($_table_skip['email'])): ?>
                <td><?php echo e($userObj->email); ?></td>
            <?php endif; ?>
            <?php if(!isset($_table_skip['roles'])): ?>
                <td>
                    <?php if($userObj->role): ?>
                        <?php echo e(trans('users.users.roles')[$userObj->role]); ?>

                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if(!isset($_table_skip['school'])): ?>
                <td>
                    <?php if(count($userObj->schools) > 0): ?>
                        <ul>
                            <?php $__currentLoopData = $userObj->schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(action('Users\Schools\SchoolController@show', [$schoolObj->code])); ?>">
                                        <?php echo e($schoolObj->name); ?>

                                    </a>
                                    <?php if($schoolObj->pivot->role): ?>
                                        (<?php echo e(trans('users.schools.roles')[$schoolObj->pivot->role]); ?>)
                                    <?php endif; ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if(!isset($_table_skip['groups'])): ?>
                <td>
                    <?php if(count($userObj->groups) > 0): ?>
                        <ul>
                            <?php $__currentLoopData = $userObj->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(action('Users\Groups\GroupController@show', [$schoolObj->code])); ?>">
                                        <?php echo e($groupObj->name); ?>

                                    </a>
                                    <?php if($groupObj->pivot->role): ?>
                                        (<?php echo e(trans('users.groups.roles')[$groupObj->pivot->role]); ?>)
                                    <?php endif; ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if(isset($_table_actions)): ?>
                <td>
                    <?php $__currentLoopData = $_table_actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($action['action']($userObj)); ?>" <?php echo $action['modal'] ? 'class="btn-modal"' : ''; ?>>
                            <i class="fa <?php echo e($action['icon']); ?>" aria-hidden="true"></i>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo e($users->render()); ?>

