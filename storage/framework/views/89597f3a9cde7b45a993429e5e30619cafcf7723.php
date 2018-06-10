<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>




<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.solutions.link'), 'action' => 'Assignments\SolutionController@index', 'params' => [$assignmentObj->code]],
            [ 'label' => $solutionObj->user->fullName() . ' - ' . date('d. m. Y H:i:s', strtotime($solutionObj->created_at))]
        ]); ?>


    <h1><?php echo e($solutionObj->user->fullName() . ' - ' . date('d. m. Y H:i:s', strtotime($solutionObj->created_at))); ?></h1>

    <section id="submit-files">

        <form action="<?php echo e(action('Assignments\SolutionController@update', [$assignmentObj->code, $solutionObj->code])); ?>" method="post">
            <?php echo ContentNav::submit(['label' => trans('general.save')]); ?>

            <h3 style="margin-top: -3rem;">Manuálne hodnotenie</h3>
            <?php echo csrf_field(); ?>

            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label class="col-md-20" for="assignmentName">Pridelené body (0 - <?php echo e($assignmentService::maxReviewScore($assignmentObj, Auth::user())); ?>):</label>
                <div class="col-md-40">
                    <input type="number" class="form-control" name="review_points" min="1" max="<?php echo e($assignmentService::maxReviewScore($assignmentObj, Auth::user())); ?>"
                           value="<?php echo e(old('review_points', $solutionObj->review_points)); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-20" for="assignmentName">Komentár k hodnoteniu:</label>
                <div class="col-md-40">
                    <textarea rows="4" class="form-control" name="review"><?php echo e(old('review_points', $solutionObj->review)); ?></textarea>
                </div>
            </div>

        </form>
        <h3>Odovdané súbory</h3>
        <ul>
            <?php $__currentLoopData = $solutionObj->files()->orderBy('dirname', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(action('Assignments\SolutionController@source', [$assignmentObj->code, $solutionObj->code, $fileObj->code])); ?>">
                    <?php echo e($fileObj->dirname . ( $fileObj->dirname != '/' ? '/' : '' ) . $fileObj->filename . '.' . $fileObj->ext); ?>

                    </a>

                    <?php $comments = $fileObj->comments()->count() ?>
                    <?php if($comments > 0): ?>
                        <span class="text-danger" style="margin-left: 20px"><?php echo e($comments); ?> <i class="fa fa-comment" aria-hidden="true"></i> </span>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>