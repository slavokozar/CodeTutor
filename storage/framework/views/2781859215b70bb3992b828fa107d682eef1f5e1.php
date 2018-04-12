<?php $__env->startSection('content-main'); ?>
    <?php

        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
        ];

        if($articleObj->id){
            $breadcrumb[] = [ 'action' => 'Articles\ArticleController@show', 'params' => [$articleObj->code], 'label' => $articleObj->name];
            $breadcrumb[] = [ 'label' => trans('articles.articles.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('articles.articles.create') ];
        }

    ?>

    <?php echo BreadCrumb::render($breadcrumb); ?>


    <?php if($articleObj->id): ?>
        <h1><?php echo e($articleObj->name); ?></h1>
    <?php else: ?>
        <h1><?php echo e(trans('articles.articles.create')); ?></h1>
    <?php endif; ?>

    <?php
        if($articleObj->id == null){
            $_form_action = 'Articles\ArticleController@store';
            $_form_params = [$articleObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Articles\ArticleController@update';
            $_form_params = [$articleObj->code];
            $_form_method = 'put';
        }
    ?>

    <form class="form-horizontal" action="<?php echo e(action($_form_action, $_form_params)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <?php if($_form_method != 'post'): ?>
            <input type="hidden" name="_method" value="<?php echo e($_form_method); ?>">
        <?php endif; ?>

        <?php echo ContentNav::submit(['label' => trans('general.buttons.save')]); ?>


        <section id="basic">

            <?php if($articleObj->id != null): ?>
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        <?php echo e($articleObj->code); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if($articleObj->images()->count() == 0): ?>
            <?php else: ?>
                <ul>
                    <?php $__currentLoopData = $articleObj->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($imageObj->name); ?>.<?php echo e($imageObj->ext); ?></li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleName"><?php echo e(trans('articles.labels.name')); ?></label>
                <div class="col-md-40">
                    <input id="articleName" type="text" class="form-control" name="name"
                           value="<?php echo e(old('name', $articleObj->name)); ?>">
                    <?php if( $errors->has('name') ): ?>
                        <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
            </div>


            

            <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <label class="col-md-20" for="articleDescription"><?php echo e(trans('articles.labels.description')); ?></label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>
                            <input name="articleNoDescription"
                                   type="checkbox" <?php echo e(old('no-description') ? 'checked' : ''); ?>><?php echo e(trans('articles.labels.description-same-as-article')); ?>

                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="<?php echo e(trans('articles.labels.description')); ?>"
                              ><?php echo e(old('description', $articleObj->description)); ?></textarea>
                    <?php if( $errors->has('description') ): ?>
                        <span class="help-block"><?php echo e($errors->first('description')); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                <label class="col-md-60" for="articleContent"><?php echo e(trans('articles.labels.content')); ?></label>
                <div class="col-md-60">


                    <textarea id="articleContent" class="form-control" name="text" rows="10"
                              placeholder="<?php echo e(trans('articles.labels.text')); ?>"><?php echo e(old('text', $articleObj->text)); ?></textarea>
                    <?php if( $errors->has('text') ): ?>
                        <span class="help-block"><?php echo e($errors->first('text')); ?></span>
                    <?php endif; ?>
                </div>
            </div>


        </section>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/simplemde.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.iframe-transport.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.fileupload.js')); ?>"></script>

    <script>
        var simplemde = new SimpleMDE({
            element: $("#articleContent")[0],
            spellChecker: false,
            imagesModalUrl: '<?php echo e(action('Articles\ImageController@index', [$articleObj->id == null ? 'null' : $articleObj->code])); ?>',
            imagesModalInit: function () {
                $('#images-upload a').click(function () {
                    // console.log('klik upload');
                    $(this).parent().find('input').click();
                });

                $('#images-upload').fileupload({

                    // This element will accept file drag/drop uploading
                    // dropZone: $('#upload-drop'),
                    dataType: 'json',
                    autoUpload: true,
                    maxChunkSize: 1000000,
                    method: "POST",
                    sequentialUploads: true,
                    loader: false,

                    // This function is called when a file is added to the queue;
                    // either via the browse button, or via drag/drop:
                    start: function (e, data) {
                        e.stopPropagation();
                        e.preventDefault();


                        var progress =
                            '<div id="images-progress-bar" class="progress">' +
                            '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">' +
                            '<span class="sr-only">0%</span>' +
                            '</div>' +
                            '</div>' +
                            '<div id="images-progress-val">0%</div>';

                        $('#images-upload').after(progress);
                    },

                    add: function (e, data) {

                        var jqXHR = data.submit();
                    },

                    fail: function (e, data) {
                        console.log(e);

                        return;
                    },

                    done: function (e, data) {
                        var url = '<?php echo e(action('Files\ImageController@modalThumb', '?')); ?>';
                        console.log(url);
                        url = url.replace('?', data.result.code);
                        console.log(url);

                        $.ajax({
                            method: 'get',
                            url: url,
                            global: false
                        }).done(function (data) {
                            $element = $(data);
                            $('.media-file-loader').last().replaceWith($element);

                            $('#images-empty').remove();
                            $('#images-row').append($element);

                            initImageSelector($element);


                            // App.module.contentModal.partials.images.bindSelect($element.find('.media-image-item'));
                        }).error(function (msg) {
                            console.log("chyba pocas zobrazovanie uploadnuteho suboru");
                        })
                    },

                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);

                        $progressBar = $('#images-progress-bar');
                        $progressVal = $('#images-progress-val');

                        $progressBar.css({width: progress + '%'}).find('.sr-only').html(progress + '%');
                        $progressVal.html(progress + '%');

                        if (progress == 100) {
                            $progressBar.addClass('progress-bar-success');
                            window.setTimeout(function () {
                                $progressBar.remove();
                                $progressVal.remove();
                            }, 3000);
                        }
                    }
                });

                // Prevent the default action when a file is dropped on the window
                $(document).on('drop dragover', function (e) {
                    e.preventDefault();
                });
            },

        });

        simplemde.codemirror.on('refresh', function () {
            if ($(simplemde.element).closest('.form-group').find('.CodeMirror').hasClass('CodeMirror-fullscreen')) {
                var width = $('#content-navigation').width();
                $('#content-navigation').css({
                    'position': 'fixed',
                    'top': '90px',
                    'width': width + 'px',
                    'margin': 0
                });

                $('.navbar').addClass('navbar-bg');

            } else {
                $('#content-navigation').removeAttr('style');

                if ($(window).scrollTop() > 20) {
                    $('.navbar').addClass('navbar-bg');
                }
                else {
                    $('.navbar').removeClass('navbar-bg');
                }
            }
        });

        function initImageSelector($element){
            $element.find('.images-square').click(function(){
                $image = $(this);

                $image.toggleClass('selected');
            });
        }
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>