<?php $__env->startSection('content'); ?>
    <div id="auth" class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Reset hesla</h1>
                </div>
                <div class="col-md-4 col-md-offset-4 text-center">

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <?php if($errors->has('email')): ?>
                                <span class="help-block"><?php echo e($errors->first('email')); ?></span>
                            <?php endif; ?>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="<?php echo e(old('email')); ?>" required placeholder="Email">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-danger">
                                Resetovať
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>