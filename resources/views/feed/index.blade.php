@extends('layouts.main')

@section('content-main')
    <section id="activities-list">

        <h1 style="margin-top: 5rem;">{{ trans('feed.heading') }}</h1>

        @if( Auth::check() && Auth::user()->isAuthor())

            <div id="feed-add-content">
                <div>
                    <a href="{{ action('Links\LinkController@create') }}">
                        <span class="fa fa-link" aria-hidden="true"></span>
                        <div class="label">{{ trans('links.add') }}</div>
                    </a>
                </div>
                <div>
                    <a href="{{ action('Files\FileController@create') }}">
                        <span class="fa fa-file-o" aria-hidden="true"></span>
                        <div class="label">{{ trans('files.add') }}</div>
                    </a>
                </div>
                <div>
                    <a href="{{ action('Articles\ArticleController@create') }}">
                        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                        <div class="label">{{ trans('articles.add') }}</div>
                    </a>
                </div>
                <div>
                    <a href="{{ action('Assignments\AssignmentController@create') }}">
                        <span class="fa fa-graduation-cap" aria-hidden="true"></span>
                        <div class="label">{{ trans('assignments.add') }}</div>
                    </a>
                </div>
            </div>
        @endif

        @if(count($activities) == 0)
            <p class="text-center text-danger">{!! trans('feed.no-activity') !!}</p>
        @else
            @foreach($activities as $activityObj)

                <div class="activity">
                    @if($activityObj->object_type == 'link')
                        @php $linkObj = $activityObj->object() @endphp
                        @include('links.activity')

                    @elseif($activityObj->object_type == 'file')
                        @php $fileObj = $activityObj->object() @endphp
                        @include('files.activity')

                    @elseif($activityObj->object_type == 'article')
                        @php $articleObj = $activityObj->object() @endphp
                        @include('articles.activity')

                    @elseif($activityObj->object_type == 'assignment')
                        @php $assignmentObj = $activityObj->object() @endphp
                        @include('assignments.activity')

                    @endif
                </div>

            @endforeach
        @endif
    </section>

@endsection

@section('scripts')
    @if( Auth::check() && Auth::user()->isAdmin())
        <script>
            $(function () {
                $('#create-content').click(function (e) {
                    e.preventDefault();

                    console.log('show buttons');
                })
            });
        </script>
    @endif
@endsection