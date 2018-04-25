<?php $assignmentService = app('App\Services\Assignments\AssignmentService'); ?>

<div id="assignment-info">
<span class="assignment-deadline">zostáva <?php echo $assignmentService->deadline($assignmentObj); ?></span>
    <?php if(Auth::check()): ?>
        
        
        
        
            
            
        
        
            
            
        
    <?php endif; ?>
</div>