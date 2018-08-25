<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>




<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.history.link')]
        ]); ?>


    <h1><?php echo e(trans('assignments.history.link')); ?></h1>

    <section id="submit-history">

        <?php $__currentLoopData = $solutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solutionObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $time = strtotime($solutionObj->created_at) ?>
            <h4><?php echo e(date('d. m. Y', $time)); ?> <span><?php echo e(date('H:i:s', $time)); ?></span></h4>
            <div class="row">
                <div class="col-lg-20 col-lg-push-40 text-right">
                    <div id="assignment-stats">
                        <div class="assignment-value">
                            automatický test
                            <span><?php echo e($assignmentService::userTestScore($assignmentObj, Auth::user())); ?></span>
                            /
                            <span><?php echo e($assignmentService::maxTestScore($assignmentObj, Auth::user())); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-40 col-lg-pull-20">
                    <div class="row">
                        <div class="col-md-20"><label><?php echo e(trans('assignments.submit.file')); ?></label></div>
                        <div class="col-md-40">
                            <?php echo $solutionObj->icon(); ?> <?php echo e($solutionObj->filename); ?>

                        </div>
                    </div>


                </div>
            </div>

            <a class="read-more" href="<?php echo e(action('Assignments\SolutionController@show', [$assignmentObj->code, $solutionObj->code])); ?>">Zobraziť odovzdané riešenie...</a>
            <hr/>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        

        

        

        
        


        

        
        
        
        

        


        
        
        
        
        
        
        

        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>