<?php $__env->startSection('content'); ?>
    <div id="auth" class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-60 text-center"><h1>Prihlásenie</h1></div>
                <div class="col-md-30 text-center margin-top-lg" style="padding-top:40px">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="control-label col-md-20">email</label>

                            <div class="col-md-40">

                                <input id="email" type="email" class="form-control" name="email" placeholder="email"
                                       value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="control-label col-md-20">heslo</label>

                            <div class="col-md-40">

                                <input id="password" type="password" class="form-control" name="password"
                                       placeholder="heslo" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-md-40 col-md-offset-20 text-center">
                                <button type="submit" class="btn btn-primary">Prihlásiť sa</button>
                            </div>
                            <div class="col-md-40 col-md-offset-20 text-center">
                                <a href="<?php echo e(url('/password/reset')); ?>">
                                    Zabudol si svoje heslo?
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="col-md-30 text-center">
                    <h2>Si tu prvý krát?</h2>
                    <a href="<?php echo e(action('Auth\RegisterController@showRegistrationForm')); ?>"
                       class="btn btn-lg btn-danger margin-top-lg">
                        Registruj sa
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>