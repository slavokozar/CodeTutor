<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.' . $data . '.link'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@index' ]
        ]); ?>


    <h1><?php echo e(trans('assignments.' . $data . '.heading')); ?></h1>

    <?php echo ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@create', 'params' => [$assignmentObj->code]]
            ]
        ]); ?>


    <section>

        <?php if(count($testdata) == 0): ?>
            <p class="text-center text-danger"><?php echo trans('assignments.' . $data . '.no-' . $data); ?></p>
        <?php else: ?>
            <?php $__currentLoopData = $testdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testdataObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $json = json_decode($testdataObj->data) ?>


                <div class="testdata">
                    <div class="testdata-header">
                        <h3><a href="#"><?php echo e(trans('assignments.datapub.link')); ?> #<?php echo e($testdataObj->number); ?></a></h3>

                        <div class="testdata-buttons">
                            <?php if($testdataObj->number > 1): ?>
                                <a href="<?php echo e(action('Assignments\\' . ucfirst($data) . 'Controller@moveUp', [$assignmentObj->code, $testdataObj->number])); ?>"
                                   class="btn">
                                    <span class="fa fa-arrow-up" aria-hidden="true"></span>
                                </a>
                            <?php endif; ?>
                            <?php if($testdataObj->number < count($testdata)): ?>
                                <a href="<?php echo e(action('Assignments\\' . ucfirst($data) . 'Controller@moveDown', [$assignmentObj->code, $testdataObj->number])); ?>"
                                   class="btn">
                                    <span class="fa fa-arrow-down" aria-hidden="true"></span>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(action('Assignments\\' . ucfirst($data) . 'Controller@edit', [$assignmentObj->code, $testdataObj->number])); ?>"
                               class="btn">
                                <?php echo e(trans('general.edit')); ?>

                            </a>
                            <a href="<?php echo e(action('Assignments\\' . ucfirst($data) . 'Controller@deleteModal', [$assignmentObj->code, $testdataObj->number])); ?>"
                               class="btn btn-modal">
                                <?php echo e(trans('general.delete')); ?>

                            </a>
                        </div>

                    </div>
                    <div class="testdata-data">
                        <p><?php echo e($testdataObj->description); ?></p>
                        <div class="row">


                            <div class="testdata-input col-md-25">
                                <h4>Input</h4>
                                <div class="data-collapser collapsed">
                                    <div class="data-content">
                                        <div class="data-values">
                                            <?php for($i = 0; $i < $json->input->count; $i++): ?>
                                                <div class="data-line"><?php echo e($json->input->inputs[$i]); ?></div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="data-button">
                                        <span class="fa fa-angle-double-down" aria-hidden="true"></span>
                                        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="testdata-output col-md-35">
                                <h4>Output</h4>


                                <div class="data-collapser collapsed">
                                    <div class="data-content">
                                        <div class="data-values">
                                            <?php for($i = 0; $i < $json->output->tasksCount; $i++): ?>
                                                <div class="data-line">##task<?php echo e($i + 1); ?></div>
                                                <?php $__currentLoopData = $json->output->tasks[$i]->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="data-line">
                                                        <div><?php echo e($line->value); ?></div>
                                                    </div>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="data-type">
                                            <?php for($i = 0; $i < $json->output->tasksCount; $i++): ?>
                                                <div class="data-line">&nbsp;</div>
                                                <?php $__currentLoopData = $json->output->tasks[$i]->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="data-line">
                                                        <strong><?php echo e($line->points); ?> bodov</strong>
                                                        &nbsp;
                                                        <i><?php echo e($line->typedef); ?> <?php echo e($line->typedef != 'String' ? '(presnost ' . $line->precision . ')' : ''); ?></i>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="data-button">
                                        <span class="fa fa-angle-double-down" aria-hidden="true"></span>
                                        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>

        $('.data-collapser .data-button').click(function () {
            $(this).closest('.data-collapser').toggleClass('collapsed');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>