<?php
    $_delete_action = action('Users\Schools\AdminController@destroy',[$schoolObj->code, $userObj->code]);
?>

<?php echo $__env->make('users.partials.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>