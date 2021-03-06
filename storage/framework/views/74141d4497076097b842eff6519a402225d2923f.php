<?php $assignmentService = app('Facades\App\Services\Assignments\AssignmentService'); ?>



<?php $__env->startSection('content-main'); ?>

    <?php echo BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.solutions.link'), 'action' => 'Assignments\SolutionController@index', 'params' => [$assignmentObj->code]],
            [ 'label' => $solutionObj->user->fullName() . ' - ' . date('d. m. Y H:i:s', strtotime($solutionObj->created_at)), 'action' => 'Assignments\SolutionController@show', 'params' => [$assignmentObj->code, $solutionObj->code]],
            [ 'label' => $fileObj->dirname . ($fileObj->dirname != '/' ? '/' : '' )  . $fileObj->filename . '.' . $fileObj->ext]
        ]); ?>



    <h1><?php echo e($fileObj->filename . '.' . $fileObj->ext); ?></h1>

    <?php if(Auth::check() and Auth::user()->isAuthor()): ?>
        <form action="<?php echo e(action('Assignments\SolutionController@comments', [$assignmentObj->code, $solutionObj->code, $fileObj->code])); ?>" method="post">
            <?php echo csrf_field(); ?>

            <input id="form-comments" type="hidden" name="comments" value="">


            <?php echo ContentNav::submit(['label' => trans('general.save')]); ?>

        </form>
    <?php endif; ?>

    <section id="submit-source">

        <section>
            <div id="source">
                <pre class="brush: java"><?php echo e($content); ?></pre>
            </div>
        </section>

    </section>

    <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Okomentovať riadok</h4>
                </div>
                <div class="modal-body">
                            <textarea id="comment-text" class="form-control" rows="3"
                                      placeholder="Komentár..." <?php echo e((!Auth::check() or !Auth::user()->isAuthor()) ? 'disabled' : ''); ?>></textarea>
                </div>
                <div class="modal-footer">
                    <button id="comment-cancel" type="button"
                            class="btn btn-default"><?php echo e(trans('general.cancel')); ?></button>
                    <button id="comment-save" type="button"
                            class="btn btn-danger"><?php echo e(trans('general.save')); ?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        // SyntaxHighlighter.defaults['highlight'] = [1,3];
        SyntaxHighlighter.all();

        var actualButton = null;
        var actualLine = null;
        var comments = JSON.parse('<?php echo json_encode($comments); ?>');
        console.log(comments);

        function waitForHighlight() {
            setTimeout(function () {
                if ($('#source .syntaxhighlighter').length == 0) {
                    waitForHighlight();
                } else {
                    $('#source .syntaxhighlighter .gutter .line').each(function () {
                        var $btn = $('<a href="#" class="source-comment"><i class="fa fa-comment" aria-hidden="true"></i></a>');

                        var className = $(this).attr('class').match(/number([0-9]*)/);
                        if (className && className.length > 0) {
                            var line  = parseInt(className[0].replace('number', ''));

                            if (typeof comments[line] !== 'undefined') {
                                $btn.addClass('active');
                            }
                        }


                        $(this).append($btn);
                    });
                    startCommenting();
                }
            }, 500);
        };
        waitForHighlight();

        function startCommenting() {
            $(document).on('click', '.source-comment', function (e) {
                e.preventDefault();
                e.stopPropagation();

                actualButton = $(this).closest('.source-comment');

                var className = $(e.target).closest('.line').attr('class').match(/number([0-9]*)/);
                if (!className || className.length == 0) {
                    return null;
                }

                actualLine = parseInt(className[0].replace('number', ''));

                $('#comment-text').val(comments[actualLine]);
                $('#reviewModal').modal('show');
            })
        }

        $('#comment-cancel').click(function () {
            $('#reviewModal').modal('hide');
            $('#comment-text').val('');
        });

        $('#comment-save').click(function () {
            var text = $('#comment-text').val();

            if (text == '') {
                delete comments[actualLine]; // or use => delete test   ['blue'];
                actualButton.removeClass('active')
            } else {
                comments[actualLine] = text;
                actualButton.addClass('active')

            }

            $('#reviewModal').modal('hide');
            $('#comment-text').val('');

            $('#form-comments').val(JSON.stringify(comments));
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>