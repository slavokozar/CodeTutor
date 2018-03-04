<div {!! isset($testNo) ? 'id="test-test' . ($testNo + 1) .'"' : '' !!} class="test-test">
    <div class="row">
        <div class="col-lg-30">
            <h3>Test {{isset($testNo) ? $testNo + 1 : ''}}</h3>
        </div>
        <div class="col-lg-30 text-right">
            <button class="btn btn-link btn-test-remove text-danger">
                <i class="fa fa-times" aria-hidden="true"></i> Odstániť test
            </button>
        </div>
    </div>
    <div class="row form-group-sm">
        <label class="col-lg-10  control-label control-label-sm">Popis:</label>
        <div class="col-lg-20 ">
            <input type="text" name="description" class="form-control form-control-sm" placeholder="Popis" value="{{$test->description}}">
        </div>
        <label class="col-lg-10  control-label control-label-sm">Timeout:</label>
        <div class="col-lg-20 ">
            <input type="number" name="timeout" class="form-control form-control-sm" placeholder="Timeout" value="{{$test->timeout}}">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-20">
            <h4>Vstupy</h4>
            <div class="form-group">
                <textarea name="input" class="form-control form-control-sm" rows="{{$test->input->count + 1}}">@foreach($test->input->inputs as $input){{$input.PHP_EOL}}@endforeach</textarea>
            </div>
        </div>
        <div class="col-lg-40">
            <h4>Výstupy</h4>
            <div class="test-tasks">
                @if($test->output->tasksCount > 0)
                    @for($taskNo = 0; $taskNo < $test->output->tasksCount; $taskNo++)
                        <?php $task = $test->output->tasks[$taskNo] ?>
                        @include('assignments.tests.test-task')
                    @endfor
                @else
                    <p class="test-notask text-center text-danger">K tomuto zadaniu zatiaľ neexistujú testy.</p>
                @endif
            </div>
            <div class="row">
                <div class="col-md-60 text-center">
                    <a href="{{action('Assignments\TestController@newTask', [$assignmentObj->code, $data])}}" class="btn btn-link btn-task-add">
                        <i class="fa fa-plus" aria-hidden="true"></i> Pridať úlohu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
