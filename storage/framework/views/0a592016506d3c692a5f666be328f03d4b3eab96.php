<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="CodeLeague - SlavomirKozar.sk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="CodeLeague">

    <title>CodeLeague</title>

    <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('img/codeleague.ico')); ?>" type="image/x-icon">
</head>
<body>
<?php echo $__env->make('navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('wrapper'); ?>

<?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

            })
        });
    });
</script>
<?php echo $__env->yieldContent('scripts'); ?>


</body>
</html>