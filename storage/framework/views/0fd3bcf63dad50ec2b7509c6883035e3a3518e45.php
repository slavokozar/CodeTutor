<?php $__env->startSection('content'); ?>

    <main role="main" class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h1>Registrovat</h1>
                </div>


                <div class="col-md-40 col-md-offset-10 text-center">

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-20 control-label">titul</label>

                            <div class="col-md-40">
                                <?php if($errors->has('title')): ?>
                                    <span class="help-block"><?php echo e($errors->first('title')); ?></span>
                                <?php endif; ?>
                                <input id="name" type="text" class="form-control" name="title"
                                       value="<?php echo e(old('title')); ?>" autofocus placeholder="titul">
                            </div>

                        </div>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-20 control-label">meno</label>

                            <div class="col-md-40">
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                                <input id="name" type="text" class="form-control" name="name"
                                       value="<?php echo e(old('name')); ?>" autofocus placeholder="meno">
                            </div>

                        </div>

                        <div class="form-group<?php echo e($errors->has('surname') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-20 control-label">priezvisko</label>

                            <div class="col-md-40">
                                <?php if($errors->has('surname')): ?>
                                    <span class="help-block"><?php echo e($errors->first('surname')); ?></span>
                                <?php endif; ?>
                                <input id="name" type="text" class="form-control" name="surname"
                                       value="<?php echo e(old('surname')); ?>" autofocus placeholder="priezvisko">
                            </div>

                        </div>

                        <div class="form-group<?php echo e($errors->has('date') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-20 control-label">dátum narodenia</label>

                            <div class="col-md-40">
                                <?php if($errors->has('date')): ?>
                                    <span class="help-block"><?php echo e($errors->first('date')); ?></span>
                                <?php endif; ?>
                                <input id="date" type="text" class="form-control" name="date"
                                       value="<?php echo e(old('date')); ?>" placeholder="dátum narodenia">
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('school_id') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-20 control-label">škola</label>

                            <div class="col-md-40">

                                <?php if($errors->has('school_id')): ?>
                                    <span class="help-block"><?php echo e($errors->first('school_id')); ?></span>
                                <?php endif; ?>

                                <select id="school_id" name="school_id" class="form-control">
                                    <option value="">Vyberte školu...</option>
                                    <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($school->id); ?>"
                                                <?php if(old('school_id') !== null && old('school_id') == $school->id): ?> selected <?php endif; ?>><?php echo e($school->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-20 control-label">email</label>

                            <div class="col-md-40">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="<?php echo e(old('email')); ?>" placeholder="email">

                            </div>
                        </div>

                        <div class="form-group password-control<?php echo e($errors->has('password') ? ' has-error' : ''); ?>"
                             style="position:relative">
                            <label for="name" class="col-md-20 control-label">heslo</label>

                            <div class="col-md-40">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block"><?php echo e($errors->first('password')); ?></span>
                                <?php endif; ?>
                                <input id="password" type="password" class="form-control" name="password"
                                       style="margin-right:30px;" placeholder="heslo">
                                <i class="fa fa-eye" aria-hidden="true"
                                   style="position:absolute; font-size: 26px; bottom: 12px; right:50px; color:#373737"></i>
                            </div>
                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-danger">
                                Registrovať
                            </button>

                        </div>
                    </form>

                </div>
            </div>


    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $('.password-control .fa').mousedown(function () {
            $(this).closest('.password-control').find('input').attr('type', 'text');
            $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash');
        });

        $('.password-control .fa').mouseup(function () {
            $(this).closest('.password-control').find('input').attr('type', 'password');
            $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash');
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>