@extends('layouts.main')

@section('content-main')

    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.' . $data . '.link'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@index' ]
        ])
    !!}

    <h1>{{ trans('assignments.' . $data . '.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@create', 'params' => [$assignmentObj->code]]
            ]
        ])
     !!}

    <section>

        @if(count($testdata) == 0)
            <p class="text-center text-danger">{!! trans('assignments.' . $data . '.no-' . $data) !!}</p>
        @else
            @foreach($testdata as $testdataObj)
                @php $json = json_decode($testdataObj->data) @endphp


                <div class="testdata">
                    <div class="testdata-header">
                        <h3><a href="#">{{ trans('assignments.datapub.link') }} #{{$testdataObj->number}}</a></h3>

                        <div class="testdata-buttons">
                            @if($testdataObj->number > 1)
                                <a href="{{ action('Assignments\\' . ucfirst($data) . 'Controller@moveUp', [$assignmentObj->code, $testdataObj->number]) }}"
                                   class="btn">
                                    <span class="fa fa-arrow-up" aria-hidden="true"></span>
                                </a>
                            @endif
                            @if($testdataObj->number < count($testdata))
                                <a href="{{ action('Assignments\\' . ucfirst($data) . 'Controller@moveDown', [$assignmentObj->code, $testdataObj->number]) }}"
                                   class="btn">
                                    <span class="fa fa-arrow-down" aria-hidden="true"></span>
                                </a>
                            @endif
                            <a href="{{ action('Assignments\\' . ucfirst($data) . 'Controller@edit', [$assignmentObj->code, $testdataObj->number]) }}"
                               class="btn">
                                {{ trans('general.edit') }}
                            </a>
                            <a href="{{ action('Assignments\\' . ucfirst($data) . 'Controller@deleteModal', [$assignmentObj->code, $testdataObj->number]) }}"
                               class="btn btn-modal">
                                {{ trans('general.delete') }}
                            </a>
                        </div>

                    </div>
                    <div class="testdata-data">
                        <p>{{ $testdataObj->description }}</p>
                        <div class="row">


                            <div class="testdata-input col-md-25">
                                <h4>Input</h4>
                                <div class="data-collapser collapsed">
                                    <div class="data-content">
                                        <div class="data-values">
                                            @for($i = 0; $i < $json->input->count; $i++)
                                                <div class="data-line">{{ $json->input->inputs[$i] }}</div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="data-button">
                                        <span class="fa fa-angle-double-down" aria-hidden="true"></span>
                                        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="testdata-output col-md-35">
                                <h4>Output</h4>


                                <div class="data-collapser collapsed">
                                    <div class="data-content">
                                        <div class="data-values">
                                            @for($i = 0; $i < $json->output->tasksCount; $i++)
                                                <div class="data-line">##task{{ $i + 1 }}</div>
                                                @foreach($json->output->tasks[$i]->lines as $line)
                                                    <div class="data-line">
                                                        <div>{{ $line->value }}</div>
                                                    </div>

                                                @endforeach
                                            @endfor
                                        </div>
                                        <div class="data-type">
                                            @for($i = 0; $i < $json->output->tasksCount; $i++)
                                                <div class="data-line">&nbsp;</div>
                                                @foreach($json->output->tasks[$i]->lines as $line)
                                                    <div class="data-line">
                                                        <strong>{{ $line->points }} bodov</strong>
                                                        &nbsp;
                                                        <i>{{ $line->typedef }} {{ $line->typedef != 'String' ? '(presnost ' . $line->precision . ')' : '' }}</i>
                                                    </div>
                                                @endforeach
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="data-button">
                                        <span class="fa fa-angle-double-down" aria-hidden="true"></span>
                                        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        @endif
    </section>
@endsection

@section('scripts')
    <script>

        $('.data-collapser .data-button').click(function () {
            $(this).closest('.data-collapser').toggleClass('collapsed');
        });
    </script>
@endsection