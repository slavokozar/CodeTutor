@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link') ]
        ])
    !!}


    <h1>{{ trans('assignments.heading') }}</h1>

    @if(Auth::check() && Auth::user()->isAuthor())
    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Assignments\AssignmentController@create']
            ]
        ])
     !!}
    @endif

    <section id="activities-list">

        @if(count($assignments) == 0)
            <p class="text-center text-danger">{!! trans('assignments.no-assignments') !!}</p>
        @else
            @foreach($assignments as $assignmentObj)
                @php $activityObj = $assignmentObj @endphp
                <div class="activity">
                    @include('assignments.activity')
                </div>

            @endforeach
            {!! $assignments->render() !!}
        @endif
    </section>
@endsection

@section('scripts')
    <script>
        var sizes = [14, 18, 22, 26, 32];
        $('#sidebar span').each(function () {

            var size = $(this).data('size');

            $(this).css({
                'font-size': sizes[size]
            });
        })
    </script>
@endsection