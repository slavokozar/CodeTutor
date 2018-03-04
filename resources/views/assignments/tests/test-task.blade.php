<div class="test-task">
    <div class="row">
        <div class="col-lg-50">
            <h4>Úloha {{isset($taskNo) ? $taskNo + 1 : ''}}</h4>
        </div>
        <div class="col-lg-10 text-right">
            <a href="#" class="btn-task-remove">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="row test-line">
        <div class="col-lg-32">
            <label class="control-label control-label-sm">Výstup</label>
        </div>
        <div class="col-lg-8">
            <label class="control-label control-label-sm">Body</label>
        </div>
        <div class="col-lg-8">
            <label class="control-label control-label-sm">Typ</label>
        </div>
        <div class="col-lg-8">
            <label class="control-label control-label-sm">Presnosť</label>
        </div>
    </div>
    <div class="test-lines">
        @if($task->linesCount > 0)
            @for($lineNo = 0; $lineNo < $task->linesCount; $lineNo++)
                <?php $line = $task->lines[$lineNo] ?>
                @include('assignments.tests.test-line')
            @endfor
        @else
            <p class="noline text-center text-danger">K tomuto zadaniu zatiaľ neexistujú testy.</p>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-60 text-center">
            <a href="{{action('Assignments\TestController@newLine', [$assignmentObj->code, $data])}}" class="btn btn-link btn-line-add">
                <i class="fa fa-plus" aria-hidden="true"></i> Pridať riadok
            </a>
        </div>
    </div>
</div>