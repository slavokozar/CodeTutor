<!DOCTYPE html>
<html>
<head>
    <?php echo $__env->make('layouts.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('img/codeleague.ico')); ?>" type="image/x-icon">
</head>
<body>
    <?php echo $__env->make('layouts.partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-select.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('js/select2.full.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(function () {
            //todo loader

            $('a.btn-modal').click(function(e){
                e.preventDefault();

                $.ajax({
                    'url': $(this).attr('href'),
                    'method': 'get'
                }).done(function(data){

                    $modal = $(data);
                    $('body').append($modal);
                    $modal.modal('show');

                    $modal.on('hidden.bs.modal', function(){
                        $modal.remove();
                    })

                    $modal.find('.js-select').select2({});

                })
            });

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>