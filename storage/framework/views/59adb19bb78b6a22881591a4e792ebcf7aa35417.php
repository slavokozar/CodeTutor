<?php $__env->startSection('sidebar'); ?>
    <h3>Tagy</h3>
    <?php $__currentLoopData = \App\Models\ArticleTag::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <span data-size="<?php echo e(rand (1, 5)); ?>"><?php echo e($tag->tag); ?></span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">Zadania</li>
    </ol>

    <h1>Zadania</h1>


        <div class="row">
            <div class="col-md-60">
                <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                    <li role="presentation">
                        <a href="<?php echo e(action('Assignments\AssignmentController@create')); ?>" class="btn">Vytvoriť nové</a>
                    </li>
                </ul>
            </div>
        </div>
    


        <p class="text-center text-danger">
            Práve tu nie su žiadne zadania.<br/>
            <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i><br/>
            Ľutujeme, ak si myslíte, že články by tu mali byť, neváhajte <a href="/#contact">kontaktovať</a> správcov.
        </p>
    

        
            
                
                    
                
                
                
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                
                
                
            
        
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var sizes = [14, 18, 22, 26, 32];
        $('#sidebar span').each(function(){

            var size = $(this).data('size');

            $(this).css({
                'font-size': sizes[size]
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>