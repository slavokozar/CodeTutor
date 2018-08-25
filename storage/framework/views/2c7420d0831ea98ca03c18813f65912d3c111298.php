<?php $__env->startSection('content-main'); ?>
    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name]
        ]); ?>


    <h1><?php echo e($assignmentObj->name); ?></h1>

    <?php echo ContentNav::render([
        'left' => [
            ['label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index', 'params' => [$assignmentObj->code] ],
        ],
        'right' => [
            ['label' => trans('assignments.datapub.link'), 'action' => 'Assignments\DatapubController@index', 'params' => [$assignmentObj->code] ],
            ['label' => trans('assignments.datatest.link'), 'action' => 'Assignments\DatatestController@index', 'params' => [$assignmentObj->code] ],
            ['label' => trans('general.edit'), 'action' => 'Assignments\AssignmentController@edit', 'params' => [$assignmentObj->code] ],
            ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Assignments\AssignmentController@deleteModal', 'params' => [$assignmentObj->code]]
        ]
    ]); ?>






    <section id="assignment">

        <div class="row">
            <div class="col-lg-30">
                <div id="" class="row">
                    <label class="col-lg-20">Autor</label>
                    <div class="col-lg-40">
                        <?php echo e($assignmentObj->author->fullName()); ?>

                    </div>

                </div>
                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie od</label>
                    <div class="col-lg-40">
                        <?php echo e($assignmentObj->start_at); ?>

                    </div>

                </div>

                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie do</label>
                    <div class="col-lg-40">
                        <?php echo e($assignmentObj->deadline_at); ?>

                    </div>

                </div>

                <div id="languages" class="row">
                    <label class="col-lg-20">Povolene jazyky</label>
                    <div class="col-lg-40">
                        <?php if(count($assignmentObj->programmingLanguages) > 0): ?>
                            <ul>
                                <?php $__currentLoopData = $assignmentObj->programmingLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programmingLanguage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($programmingLanguage->name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
            <div class="col-lg-30 text-right text-danger" >
                <?php echo $__env->make('assignments.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>


        <label for="">Text zadania</label>

        <?php echo $content; ?>

    </section>
    
        

            
                
                    
                    
                
            
                
                    
                            
                            
                            

                            
                            
                    
                
            
    
    <section id="comments">
        <h2>Komentáre</h2>
        <?php $objectObj = $assignmentObj; ?>

        <?php echo $__env->make('comments.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if(count($comments) > 0): ?>
            <p class="text-center">
                <a href="<?php echo e(action('System\CommentController@index',[$assignmentObj->commentRoute, $assignmentObj->code])); ?>">všetky komentáre</a>
            </p>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/comments.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>