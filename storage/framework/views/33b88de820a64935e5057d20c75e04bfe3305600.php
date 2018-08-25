<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>




<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index' ]
        ]); ?>


    <h1><?php echo e(trans('assignments.submit.heading')); ?></h1>

    <section id="submit">

        <?php if($assignmentObj->checked_at == null): ?>
            <p class="text-center text-danger">Toto zadanie ešte nebolo validované.</p>
        <?php elseif(strtotime($assignmentObj->start_at) > time()): ?>
            <p class="text-center text-danger">Toto zadanie ešte nie je možné odovzdávať.</p>
        <?php elseif(strtotime($assignmentObj->deadline_at) < time()): ?>
            <p class="text-center text-danger">Toto zadanie už nie je možné odovzdávať.</p>
        <?php endif; ?>

        
        <div class="row">
            <div class="col-lg-20 col-lg-push-40 text-right">
                <div id="assignment-info">
                    <div class="assignment-deadline">zostáva <?php echo $assignmentService::deadline($assignmentObj); ?></div>
                    <?php if(Auth::check()): ?>
                        <div class="assignment-deadline">
                            odovzdaní
                            <span><?php echo e($assignmentService::userSolutions($assignmentObj, Auth::user())); ?></span>
                        </div>
                        <div class="assignment-deadline">
                            automatiký test
                            <span><?php echo e($assignmentService::userTestScore($assignmentObj, Auth::user())); ?></span> /
                            <span><?php echo e($assignmentService::maxTestScore($assignmentObj, Auth::user())); ?></span>
                        </div>
                        <div class="assignment-deadline">
                            manuálne hodnotenie
                            <span><?php echo e($assignmentService::userReviewScore($assignmentObj, Auth::user())); ?></span> /
                            <span><?php echo e($assignmentService::maxReviewScore($assignmentObj, Auth::user())); ?></span>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-40 col-lg-pull-20">
                <h2>Odovzdanie riešenia</h2>

                <form id="submit-upload" method="post" enctype="multipart/form-data"
                      action="<?php echo e(action('Assignments\SubmitController@upload',[$assignmentObj->code])); ?>">

                    <?php echo csrf_field(); ?>


                    <input type="file" name="file" style="display:none">

                    <button type="submit" class="btn btn-primary">Vybrať súbor</button>
                    <p class="text-muted">Podporované su typy: c, cpp, java, zip</p>
                </form>


                <div id="submit-solution">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>

                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                


            </div>
        </div>
        

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/modules/upload.js')); ?>"></script>










<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>