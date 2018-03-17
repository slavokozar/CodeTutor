<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\UserController@index')); ?>"><?php echo e(trans('users.users.link')); ?></a>
        </li>
        <li>
            <a href="<?php echo e(action('Users\Schools\SchoolController@index')); ?>"><?php echo e(trans('users.schools.link')); ?></a>
        </li>
        <li class="active"><?php echo e($schoolObj->name); ?></li>
    </ol>

    <h1><?php echo e($schoolObj->name); ?></h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\AdminController@index', [$schoolObj->code])); ?>" class="btn"><?php echo e(trans('users.admins.link')); ?></a>
        </li>
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\TeacherController@index', [$schoolObj->code])); ?>" class="btn"><?php echo e(trans('users.teachers.link')); ?></a>
        </li>
        <li role="presentation">
            <a href="<?php echo e(action('Users\Schools\StudentController@index', [$schoolObj->code])); ?>" class="btn"><?php echo e(trans('users.students.link')); ?></a>
        </li>
    </ul>


    <div class="row">
        <div class="col-md-20">
            <label for=""><?php echo e(trans('users.schools.labels.address')); ?></label>
        </div>
        <div class="col-md-40">
            <?php echo e($schoolObj->address); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-20">
            <label for=""><?php echo e(trans('users.schools.labels.url')); ?></label>
        </div>
        <div class="col-md-40">
            <a href="<?php echo e($schoolObj->url); ?>" target="_blank"><?php echo e($schoolObj->url); ?></a>
        </div>
    </div>



    
        
        
        
            
            
            
            
            
            
        
        
        
        
            
                
                
                
                
                
                    
                        
                    
                
                
                    
                        
                    
                
            
        
        
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_full', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>