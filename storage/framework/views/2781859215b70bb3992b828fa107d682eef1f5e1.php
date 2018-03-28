<?php $__env->startSection('content'); ?>

    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Články</a></li>
        <li><a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>"><?php echo e($articleObj->name); ?></a></li>
        <li class="active"><?php echo e($articleObj->id != null ? 'Úprava' : 'Nové'); ?></li>
    </ol>


    <?php if($articleObj->id != null): ?>
        <h1>Úprava <?php echo e($articleObj->name); ?></h1>
        <form class="form" method="post"
              action="<?php echo e(action('Articles\ArticleController@update',[$articleObj->code])); ?>">
    <?php else: ?>
        <h1>Vytvorenie zadania</h1>
        <form class="form form-horizontal" method="post"
              action="<?php echo e(action('Articles\ArticleController@store')); ?>">
    <?php endif; ?>
    <?php echo csrf_field(); ?>


    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <?php if($articleObj->id != null): ?>
                        <a href="<?php echo e(action('Articles\ArticleController@show',[$articleObj->code])); ?>">Zrušiť</a>
                    <?php else: ?>
                        <a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Zrušiť</a>
                    <?php endif; ?>
                </li>
                <li role="presentation">
                    <button type="submit" class="btn btn-danger">
                        <?php if($articleObj->id != null): ?> Upraviť <?php else: ?> Vytvoriť <?php endif; ?>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <section id="assignments">
        <?php echo csrf_field(); ?>

        <div class="row">
            <div class="col-lg-30">
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="articleName">Názov</label>
                    <input id="articleName" type="text" class="form-control" name="name" placeholder="Názov článku"
                           value="<?php echo e(old('name') != null ? old('name') : $articleObj->name); ?>">
                    <?php if($errors->has('name')): ?>
                        <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="help-block"><?php echo e($error); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="checkbox">
                    <label>
                        <input name="is_public" type="checkbox" <?php if((old('is_public') !== null && old('is_public')) || $articleObj->is_public): ?> checked <?php endif; ?>> Verejný článok
                    </label>
                </div>

            </div>
            <div class="col-lg-30">
                <div class="form-group<?php echo e($errors->has('group') ? ' has-error' : ''); ?>">
                    <label for="assignmentGroup">Skupina</label>
                    <select id="assignmentGroup" name="group" class="form-control">
                        <option value="">Vyberte skupinu...</option>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($group->id); ?>"
                                    <?php if((old('group') !== null && old('group') == $group->id) || $articleObj->group_id == $group->id): ?> selected <?php endif; ?>><?php echo e($group->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('group')): ?>
                        <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="help-block"><?php echo e($error); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
            <label for="articleDescription">Popis</label>
            <textarea id="articleDescription" class="form-control" name="description" rows="3"
                      placeholder="Popis, ktorý sa zobrazí vo výpise článkov..."><?php echo e(old('description') != null ? old('description') : $articleObj->description); ?></textarea>
            <?php if($errors->has('description')): ?>
                <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="help-block"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
            <label for="articleContent">Content</label>
            <textarea id="articleContent" class="form-control" name="text" rows="10"
                      placeholder="Obsah článku"><?php echo e(old('text') != null ? old('text') : $articleObj->text); ?></textarea>
            <?php if($errors->has('text')): ?>
                <?php $__currentLoopData = $errors->get('text'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="help-block"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </section>

</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/simplemde.min.js')); ?>"></script>
    <script>
        var simplemde = new SimpleMDE({
            element: $("#articleContent")[0],
            spellChecker: false
        });

        simplemde.codemirror.on('refresh', function(){
            if($(simplemde.element).closest('.form-group').find('.CodeMirror').hasClass('CodeMirror-fullscreen')){
                ContentNavTabs.makeFixed();
            }else{
                ContentNavTabs.makeRelative();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>