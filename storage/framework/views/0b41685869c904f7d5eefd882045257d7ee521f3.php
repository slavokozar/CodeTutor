<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
            [ 'label' => $articleObj->name]
        ]); ?>



    <h1><?php echo e($articleObj->name); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Articles\ArticleController@edit', 'params' => [$articleObj->code]],
                ['label' => trans('general.buttons.delete'), 'action' => 'Articles\ArticleController@deleteModal', 'params' => [$articleObj->code], 'modal' => true]
            ]
        ]); ?>


    <section id="article">
        <?php echo $articleObj->text; ?>

    </section>


    
    
    {{--<?php $objectObj = $articleObj; ?>--}}

    

    
    
    
    
    
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Články</a></li>
        <li class="active">Vytvorenie</li>
    </ol>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
            [ 'label' => $articleObj->name]
        ]); ?>



    <h1>Vytvorenie zadania</h1>
    <form class="form form-horizontal" method="post"
          action="<?php echo e(action('Articles\ArticleController@store')); ?>">

    <?php echo csrf_field(); ?>


    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <a href="<?php echo e(action('Articles\ArticleController@index')); ?>">Zrušiť</a>

                </li>
                <li role="presentation">
                    <button type="submit" class="btn btn-danger">
                        Vytvoriť
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
                           value="<?php echo e(old('name')); ?>">
                    <?php if($errors->has('name')): ?>
                        <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="help-block"><?php echo e($error); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="checkbox">
                    <label>
                        <input name="is_public" type="checkbox" <?php if((old('is_public') !== null && old('is_public'))): ?> checked <?php endif; ?>> Verejný článok
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
                                    <?php if((old('group') !== null && old('group') == $group->id)): ?> selected <?php endif; ?>><?php echo e($group->name); ?></option>
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
                      placeholder="Popis, ktorý sa zobrazí vo výpise článkov..."><?php echo e(old('description')); ?></textarea>
            <?php if($errors->has('description')): ?>
                <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="help-block"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
            <label for="articleContent">Content</label>
            <textarea id="articleContent" class="form-control" name="text" rows="10"
                      placeholder="Obsah článku"><?php echo e(old('text')); ?></textarea>
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
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>