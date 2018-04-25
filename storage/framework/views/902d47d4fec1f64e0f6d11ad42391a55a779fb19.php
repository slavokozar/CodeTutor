<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="<?php echo e(action('Assignments\AssignmentController@index')); ?>">Zadania</a></li>
        <li class="active">Nové</li>
    </ol>

    <h1>Vytvorenie zadania</h1>
    <form class="form form-horizontal" method="post"
          action="<?php echo e(action('Assignments\AssignmentController@store')); ?>">

    <?php echo csrf_field(); ?>


    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <a href="<?php echo e(action('Assignments\AssignmentController@index')); ?>">Zrušiť</a>
                </li>
                <li class="active" role="presentation">
                    <button type="submit" class="btn btn-link">Vytvoriť</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
            <div class="col-md-30">
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label class="col-md-20" for="assignmentName">Názov</label>
                    <div class="col-md-40">
                        <input id="assignmentName" type="text" class="form-control" name="name"
                               placeholder="Názov zadania"
                               value="<?php echo e(old('name')); ?>">
                    </div>
                    <?php if($errors->has('name')): ?>
                        <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="help-block"><?php echo e($error); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="col-md-40 col-md-offset-20">
                        <div class="checkbox">
                            <label>
                                <input name="is_public" type="checkbox"
                                        <?php echo e(old('is_public') ? 'checked' : ''); ?>>
                                Verejné zadanie
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('group') ? ' has-error' : ''); ?>">
                    <label class="col-md-20" for="assignmentGroup">Skupina</label>

                    <div class="col-md-40">
                        <select id="assignmentGroup" name="group" class="form-control">
                            <option value="">Vyberte skupinu...</option>
                            
                                
                                    
                                
                            
                        </select>
                    </div>
                    <?php if($errors->has('group')): ?>
                        <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="help-block"><?php echo e($error); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

            </div>
            <div class="col-md-30">
                <h4>Odovzdávanie</h4>
                <div class="form-group<?php echo e($errors->has('start') ? ' has-error' : ''); ?>">
                    <label class="col-lg-20" for="assignmentStart">od:</label>
                    <div class="col-lg-40">
                        <input class="form-control" id="assignmentStart" type="date" name="start"
                               value="<?php echo e(old('start')); ?>">
                    </div>
                    <?php if($errors->has('start')): ?>
                        <div class="col-lg-60">
                            <?php $__currentLoopData = $errors->get('start'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block"><?php echo e($error); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('deadline') ? ' has-error' : ''); ?>">
                    <label class="col-lg-20" for="assignmentDeadline">do</label>
                    <div class="col-lg-40">
                        <input class="form-control" id="assignmentDeadline" type="date"
                               name="deadline"
                               value="<?php echo e(old('deadline')); ?>">
                    </div>

                    <?php if($errors->has('deadline')): ?>
                        <div class="col-lg-60">
                            <?php $__currentLoopData = $errors->get('deadline'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block"><?php echo e($error); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <h5>Povolené jazyky</h5>
                <div style="display:flex; justify-content: space-around">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox">
                            <label>
                                <input name="languages[]" type="checkbox" value="<?php echo e($languageObj->id); ?>">
                                <?php echo e($languageObj->name); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>



            </div>
            <div class="col-md-60">
                <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                    <div class="col-md-60">
                        <label for="assignmentDescription">Popis</label>

                        <textarea id="assignmentDescription" class="form-control" name="description" rows="3"
                            placeholder="Popis, ktorý sa zobrazí vo výpise zadaní..."><?php echo e(old('description')); ?></textarea>
                        <?php if($errors->has('description')): ?>
                            <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block"><?php echo e($error); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                    <div class="col-md-60">
                        <label for="assignmentContent">Content</label>
                        <textarea id="assignmentContent" class="form-control" name="text" rows="10"
                                  placeholder="Text zadania"><?php echo e(old('text')); ?></textarea>
                        <?php if($errors->has('text')): ?>
                            <?php $__currentLoopData = $errors->get('text'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block"><?php echo e($error); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/simplemde.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/assignment.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>