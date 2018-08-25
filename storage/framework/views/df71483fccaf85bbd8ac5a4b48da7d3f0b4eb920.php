<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>




<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.solutions.link')]
        ]); ?>


    <h1><?php echo e(trans('assignments.history.link')); ?></h1>

    <section id="submit-history">

        <table class="table">
            <thead>
            <tr>
                <th>Meno</th>
                <th>Dátum odovzdania</th>
                <th>Automatické hodnotenie
                    <span><?php echo e($assignmentService::maxTestScore($assignmentObj, Auth::user())); ?></span></th>
                <th>Manuálne hodnotenie
                    <span><?php echo e($assignmentService::maxReviewScore($assignmentObj, Auth::user())); ?></span></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $solutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solutionObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td>
                        <a href="<?php echo e(action('Assignments\SolutionController@show',[$assignmentObj->code, $solutionObj->code])); ?>"><?php echo e($solutionObj->user->fullName()); ?></a>
                    </td>
                    <td>
                        <a href="<?php echo e(action('Assignments\SolutionController@show',[$assignmentObj->code, $solutionObj->code])); ?>"><?php echo e(date('d. m. Y H:i:s', strtotime($solutionObj->created_at))); ?></a>
                    </td>
                    <td><?php echo e($assignmentService::userTestScore($assignmentObj, Auth::user())); ?></td>
                    <td><?php echo e($assignmentService::userReviewScore($assignmentObj, Auth::user())); ?></td>
                    </a>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>