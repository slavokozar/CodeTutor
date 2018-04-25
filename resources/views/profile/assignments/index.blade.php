@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.assignments.link') ]
        ])
    !!}

    <h1>{{ trans('profile.assignments.link') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Assignments\AssignmentController@create']
            ]
        ])
     !!}

    <section class="table-list">
        @if(count($assignments) == 0)
            <p class="text-center text-danger">{!! trans('profile.assignments.no-assignments') !!}</p>
        @else
            @foreach($assignments as $assignmentObj)
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">
                                {{$assignmentObj->name}}
                            </a>
                        </div>
                        <div class="table-column-date">{{$assignmentObj->updated_at}}</div>
                    </div>
                    <div class="table-row-description">
                        {{ $assignmentObj->description }}
                    </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection