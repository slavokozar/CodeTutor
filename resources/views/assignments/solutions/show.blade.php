@inject('assignmentService', 'Facades\App\Services\Assignments\AssignmentService')


@extends('layouts.main')

@section('content-main')

    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.solutions.link'), 'action' => 'Assignments\SolutionController@index', 'params' => [$assignmentObj->code]],
            [ 'label' => $solutionObj->user->fullName() . ' - ' . date('d. m. Y H:i:s', strtotime($solutionObj->created_at))]
        ])
    !!}

    <h1>{{ $solutionObj->user->fullName() . ' - ' . date('d. m. Y H:i:s', strtotime($solutionObj->created_at)) }}</h1>

    <section id="submit-files">

        <form action="{{ action('Assignments\SolutionController@update', [$assignmentObj->code, $solutionObj->code]) }}" method="post">
            {!! ContentNav::submit(['label' => trans('general.save')]) !!}
            <h3 style="margin-top: -3rem;">Manuálne hodnotenie</h3>
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label class="col-md-20" for="assignmentName">Pridelené body (0 - {{ $assignmentService::maxReviewScore($assignmentObj, Auth::user()) }}):</label>
                <div class="col-md-40">
                    <input type="number" class="form-control" name="review_points" min="1" max="{{ $assignmentService::maxReviewScore($assignmentObj, Auth::user()) }}"
                           value="{{ old('review_points', $solutionObj->review_points) }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-20" for="assignmentName">Komentár k hodnoteniu:</label>
                <div class="col-md-40">
                    <textarea rows="4" class="form-control" name="review">{{ old('review_points', $solutionObj->review) }}</textarea>
                </div>
            </div>

        </form>
        <h3>Odovdané súbory</h3>
        <ul>
            @foreach($solutionObj->files()->orderBy('dirname', 'asc')->get() as $fileObj)
                <li>
                    <a href="{{ action('Assignments\SolutionController@source', [$assignmentObj->code, $solutionObj->code, $fileObj->code]) }}">
                    {{ $fileObj->dirname . ( $fileObj->dirname != '/' ? '/' : '' ) . $fileObj->filename . '.' . $fileObj->ext }}
                    </a>

                    @php $comments = $fileObj->comments()->count() @endphp
                    @if($comments > 0)
                        <span class="text-danger" style="margin-left: 20px">{{ $comments }} <i class="fa fa-comment" aria-hidden="true"></i> </span>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
@endsection