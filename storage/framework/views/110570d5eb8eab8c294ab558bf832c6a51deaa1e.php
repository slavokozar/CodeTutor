<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(action('Users\Groups\TeacherController@destroy',[$groupObj->code, $userObj->code])); ?>" method="post">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="_method" value="delete">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo e(trans('users.teachers.remove')); ?></h4>
                </div>
                <div class="modal-body">
                    <p class="text-center text-danger">
                        <i class="fa fa-5x fa-exclamation-triangle" aria-hidden="true"></i>
                    </p>
                    <p class="text-center text-danger"><?php echo trans('users.teachers.remove-message', ['name' => $userObj->name, 'group' => $groupObj->name] ); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo e(trans('general.cancel')); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo e(trans('general.remove')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>