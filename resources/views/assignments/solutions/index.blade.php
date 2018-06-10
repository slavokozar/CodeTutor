@inject('assignmentService', 'Facades\App\Services\Assignments\AssignmentService')


@extends('layouts.main')

@section('content-main')

    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.solutions.link')]
        ])
    !!}

    <h1>{{ trans('assignments.history.link') }}</h1>

    <section id="submit-history">

        <table class="table">
            <thead>
            <tr>
                <th>Meno</th>
                <th>Dátum odovzdania</th>
                <th>Automatické hodnotenie
                    <span>{{ $assignmentService::maxTestScore($assignmentObj, Auth::user()) }}</span></th>
                <th>Manuálne hodnotenie
                    <span>{{ $assignmentService::maxReviewScore($assignmentObj, Auth::user()) }}</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($solutions as $solutionObj)
                <tr>

                    <td>
                        <a href="{{ action('Assignments\SolutionController@show',[$assignmentObj->code, $solutionObj->code]) }}">{{ $solutionObj->user->fullName() }}</a>
                    </td>
                    <td>
                        <a href="{{ action('Assignments\SolutionController@show',[$assignmentObj->code, $solutionObj->code]) }}">{{ date('d. m. Y H:i:s', strtotime($solutionObj->created_at)) }}</a>
                    </td>
                    <td>{{ $assignmentService::userTestScore($assignmentObj, Auth::user()) }}</td>
                    <td>{{ $assignmentService::userReviewScore($assignmentObj, Auth::user()) }}</td>
                    </a>
                </tr>
            @endforeach
            </tbody>
        </table>


    </section>
@endsection