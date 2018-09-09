<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?php echo e(action('Users\Groups\StudentController@attach',[$groupObj->code])); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo e(trans('users.students.add')); ?></h4>
                </div>
                <div class="modal-body">
                    <p class="text-center"><?php echo trans('users.groups.add-students', ['group' => $groupObj->name] ); ?></p>
                    <div class="form-group">
                        <label for=""><?php echo e(trans('users.students.link')); ?></label>
                        <select name="users[]" id="" class="form-control js-select" multiple>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($userObj->id); ?>"><?php echo e($userObj->title); ?> <?php echo e($userObj->name); ?> <?php echo e($userObj->surname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <a class="btn btn-sm btn-danger" href="<?php echo e(action('Users\Groups\StudentController@create', [$groupObj->code])); ?>">
                            <?php echo e(trans('users.students.create')); ?>

                        </a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo e(trans('general.cancel')); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo e(trans('general.add')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>