@extends('layouts.main')

@section('content-main')

    {!! BreadCrumb::render([
        [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
        [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
        [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
        [ 'label' => trans('assignments.' . $data . '.link'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@index',  'params' => [$assignmentObj->code]],
        [ 'label' => trans('assignments.' . $data . '.heading') . ' #' . $testdataObj->number]
    ]) !!}

    <h1>{{ trans('assignments.' . $data . '.heading') . ' #' . $testdataObj->number }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.edit'), 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@edit', 'params' => [$assignmentObj->code, $testdataObj->number]],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Assignments\\' . ucfirst($data) . 'Controller@deleteModal', 'params' => [$assignmentObj->code, $testdataObj->number]]
            ]
        ])
     !!}

    <section>


    </section>
@endsection

@section('scripts')
@endsection