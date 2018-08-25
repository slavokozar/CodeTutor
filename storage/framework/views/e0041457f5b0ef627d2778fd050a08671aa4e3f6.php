<?php $__env->startSection('content-main'); ?>
    <?php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.' . $data . '.link'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@index' , 'params' => [$assignmentObj->code]]
        ];

        if($testdataObj->id){
            $breadcrumb[] = [ 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@show', 'params' => [$assignmentObj->code, $testdataObj->number], 'label' => trans('assignments.' . $data . '.heading') . ' #' . $testdataObj->number];
            $breadcrumb[] = [ 'label' => trans('assignments.' . $data . '.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('assignments.' . $data . '.create') ];
        }
    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($testdataObj->id): ?>
        <h1><?php echo e(trans('assignments.' . $data . '.heading')); ?> #<?php echo e($testdataObj->number); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('assignments.' . $data . '.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($testdataObj->id == null){
            $_form_action = 'Assignments\\' . ucfirst($data) . 'Controller@store';
            $_form_params = [$assignmentObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Assignments\\' . ucfirst($data) . 'Controller@update';
            $_form_params = [$assignmentObj->code, $testdataObj->number];
            $_form_method = 'put';
        }
    ?>


    <form class="form-horizontal" action="<?php echo e(action($_form_action, $_form_params)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <?php if($_form_method != 'post'): ?>
            <input type="hidden" name="_method" value="<?php echo e($_form_method); ?>">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => trans('general.save')]); ?>


        <section id="testdata-editor">
            <div class="form-group">
                <label for="" class="col-md-20"><?php echo e(trans('assignments.labels.timeout')); ?></label>
                <div class="col-md-40">
                    <input type="number" name="timeout" value="<?php echo e(old('timeout', $testdataObj->timeout)); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="datatest-description" class="col-md-20"><?php echo e(trans('assignments.labels.description')); ?></label>
                <div class="col-md-40">
                    <textarea name="description" id="datatest-description"
                              rows="3"><?php echo e(old('description', $testdataObj->description)); ?></textarea>
                </div>
            </div>

            
            
            
            
            
            

            
            
            
            
            
            

            <?php $data = json_decode($testdataObj->data) ?>
            <div class="row">
                <div class="col-lg-25">
                    <h3>Vstup</h3>
                    <?php for($i = 0; $i < $data->input->count; $i++): ?>
                        <div class="input-line">
                            <input name="input[]" type="text" value="<?php echo e($data->input->inputs[$i]); ?>">
                            <button type="button" class="input-remove">
                                <span class="fa fa-minus-square-o" aria-hidden="true"></span>
                            </button>
                        </div>
                    <?php endfor; ?>
                    <div class="input-add">
                        <button type="button">
                            <span class="fa fa-plus-square-o" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-35">
                    <h3>Výstup</h3>
                    <?php for($i = 0; $i < $assignmentObj->tasks; $i++): ?>
                        <div class="output-task" data-task="<?php echo e($i + 1); ?>">
                            <h4>Úloha #<?php echo e($i + 1); ?></h4>
                            <div class="output-labels">
                                <label class="size-3">Výstup</label>
                                <label class="size-1">Body</label>
                                <label class="size-1">Typ</label>
                                <label class="size-1">Presnosť</label>
                            </div>
                            <?php for($j = 0; $j < $data->output->tasks[$i]->linesCount; $j++): ?>
                                <?php $outputLine = $data->output->tasks[$i]->lines[$j] ?>
                                <div class="output-line">
                                    <input name="value<?php echo e($i + 1); ?>[]" class="size-3" type="text" value="<?php echo e($outputLine->value); ?>">
                                    <input name="points<?php echo e($i + 1); ?>[]" class="size-1" type="number" value="<?php echo e($outputLine->points); ?>">
                                    <select name="type<?php echo e($i + 1); ?>[]" class="size-1">
                                        <option value="String" <?php echo e($outputLine->typedef == 'String' ? 'selected' : ''); ?>>String</option>
                                        <option value="Integer" <?php echo e($outputLine->typedef == 'Integer' ? 'selected' : ''); ?>>Integer</option>
                                        <option value="Double" <?php echo e($outputLine->typedef == 'Double' ? 'selected' : ''); ?>>Double</option>
                                    </select>
                                    <input name="accuracy<?php echo e($i + 1); ?>[]" class="size-1" type="number" <?php echo e($outputLine->typedef == 'String' ? 'disabled' : ''); ?> value="<?php echo e($outputLine->precision); ?>">
                                    <button type="button" class="output-remove">
                                        <span class="fa fa-minus-square-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            <?php endfor; ?>
                            <div class="output-add">
                                <button type="button">
                                    <span class="fa fa-plus-square-o" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {

            $(document).on('click', '.input-remove', function (e) {
                e.stopPropagation();
                e.preventDefault();
                var $line = $(e.target).closest('.input-line');

                $line.remove();
            });

            $('.input-add button').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                $(e.target).closest('.input-add').before(createInputLine());
            });

            $(document).on('keydown', '.input-line input', function (e) {

                if (e.key === 'Enter') {
                    e.preventDefault();

                    var $newLine = $(createInputLine());
                    $(e.target).closest('.input-line').after($newLine);
                    $newLine.find('input').focus();

                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();

                    var $prevLine = $(e.target).closest('.input-line').prev('.input-line');
                    if ($prevLine.length > 0) {
                        $prevLine.find('input').focus();
                    }

                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();

                    var $nextLine = $(e.target).closest('.input-line').next('.input-line');
                    if ($nextLine.length > 0) {
                        $nextLine.find('input').focus();
                    }
                }
            });


            $(document).on('click', '.output-remove', function (e) {
                e.stopPropagation();
                e.preventDefault();
                var $line = $(e.target).closest('.output-line');

                $line.remove();
            });

            $('.output-add button').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                var $lines = $(e.target).closest('.output-add');
                var task = $lines.closest('.output-task').data('task');
                $lines.before(createOutputLine(task));
            });

            $(document).on('keydown', '.output-line input, .output-line select', function (e) {

                if (e.key === 'Enter') {
                    e.preventDefault();

                    var $input = $(e.target);
                    var $line = $input.closest('.output-line');

                    var index = $input.prevAll('input, select').length;
                    var task = $line.closest('.output-task').data('task');

                    var $newLine = $(createOutputLine(task));
                    $line.after($newLine);
                    $newLine.find('input, select').eq(index).focus();

                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();

                    var $input = $(e.target);
                    var index = $input.prevAll('input, select').length;

                    var $prevLine = $input.closest('.output-line').prev('.output-line');
                    if ($prevLine.length > 0) {
                        $prevLine.find('input, select').eq(index).focus();
                    }

                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();

                    var $input = $(e.target);
                    var index = $input.prevAll('input, select').length;

                    var $nextLine = $input.closest('.output-line').next('.output-line');
                    if ($nextLine.length > 0) {
                        $nextLine.find('input, select').eq(index).focus();
                    }
                } else if (e.key === 'ArrowLeft') {
                    e.preventDefault();

                    var $prevInput = $(e.target).prev('input, select');
                    if ($prevInput.length > 0) {
                        $prevInput.focus();
                    }

                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();

                    var $nextInput = $(e.target).next('input, select');
                    if ($nextInput.length > 0) {
                        $nextInput.focus();
                    }
                }
            });

            $(document).on('change', '.output-line select', function (e) {
                var value = e.target.value;

                var $line = $(e.target).closest('.output-line');
                var $precisionInput = $line.find('input').last();
                if (value === 'string') {
                    $precisionInput.attr('disabled');
                } else {
                    $precisionInput.removeAttr('disabled');
                }
            });


            function createInputLine() {
                var line =
                    '<div class="input-line">\n' +
                    '    <input name="input[]" type="text">\n' +
                    '    <button type="button" class="input-remove">\n' +
                    '        <span class="fa fa-minus-square-o" aria-hidden="true"></span>\n' +
                    '    </button>\n' +
                    '</div>';
                return line;
            }

            function createOutputLine(task) {
                var line =
                    '<div class="output-line">\n' +
                    '    <input name="value' + task + '[]" class="size-3" type="text">\n' +
                    '    <input name="points' + task + '[]" class="size-1" type="number">\n' +
                    '    <select name="type' + task + '[]" class="size-1">\n' +
                    '        <option value="string">String</option>\n' +
                    '        <option value="integer">Integer</option>\n' +
                    '        <option value="double">Double</option>\n' +
                    '    </select>\n' +
                    '    <input name="accuracy' + task + '[]" class="size-1" type="number" disabled>\n' +
                    '    <button type="button" class="output-remove">\n' +
                    '        <span class="fa fa-minus-square-o" aria-hidden="true"></span>\n' +
                    '    </button>\n' +
                    '</div>'

                return line;
            }
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>