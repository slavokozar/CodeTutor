<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>




<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index' ]
        ]); ?>


    <h1><?php echo e($assignmentObj->name); ?></h1>

    <?php echo ContentNav::render([
        'right' => [
            ['label' => trans('assignments.history.link'), 'action' => 'Assignments\SubmitController@history', 'params' => [$assignmentObj->code] ],
        ]
    ]); ?>


    <section id="submit">

        <div class="row">
            <div class="col-lg-20 col-lg-push-40 text-right">
                <div id="assignment-stats">
                    <div class="assignment-value">zostáva <?php echo $assignmentService::deadline($assignmentObj); ?></div>
                    <?php if(Auth::check()): ?>
                        <div class="assignment-value">
                            odovzdaní
                            <span><?php echo e($assignmentService::userSolutions($assignmentObj, Auth::user())); ?></span>
                        </div>
                        <div class="assignment-value">
                            automatiký test
                            <span><?php echo e($assignmentService::userTestScore($assignmentObj, Auth::user())); ?></span>
                            /
                            <span><?php echo e($assignmentService::maxTestScore($assignmentObj, Auth::user())); ?></span>
                        </div>
                        <div class="assignment-value">
                            manuálne hodnotenie
                            <span><?php echo e($assignmentService::userReviewScore($assignmentObj, Auth::user())); ?></span>
                            /
                            <span><?php echo e($assignmentService::maxReviewScore($assignmentObj, Auth::user())); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-40 col-lg-pull-20">
                <h3><?php echo e(trans('assignments.submit.heading')); ?></h3>
                
                
                
                
                
                
                

                <form id="submit-upload" method="post" enctype="multipart/form-data"
                      action="<?php echo e(action('Assignments\SubmitController@upload',[$assignmentObj->code])); ?>">

                    <?php echo csrf_field(); ?>


                    <input type="file" name="file" style="display:none">

                    <button type="submit" class="btn btn-lg btn-danger">Vybrať súbor</button>
                    <span>Podporované typy: .c, .cpp, .java, .zip</span>


                </form>

                
                <h3>Odovzdané riešenie</h3>
                <div id="submit-solution">
                    <?php if($solution != null): ?>

                        <div id="submit-file"><?php echo $solution->icon(); ?> <?php echo e($solution->filename); ?></div>


                        
                        
                        
                        
                        
                        
                        

                        <div>
                            <a href="">Zobraziť odovzdané riešenie</a>
                        </div>

                        
                        
                        
                        
                        
                    <?php endif; ?>
                </div>
                <?php if($assignmentService::userSolutions($assignmentObj, Auth::user()) > 0): ?>
                    <h3>Staršie odovzdania</h3>
                    <div id="submit-history">
                        <a href="">Zobraziť históriu odovzdaní</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/modules/upload.js')); ?>"></script>

    
    
    

    


    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>